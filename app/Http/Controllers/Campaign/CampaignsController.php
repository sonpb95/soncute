<?php

	namespace App\Http\Controllers\Campaign;

use App\Repositories\FinancialInformationRepository as FinancialInformation;
use App\Repositories\ContributionRepository as Contribution;
use App\Repositories\CategoryRepository as Category;
use App\Repositories\CampaignRepository as Campaign;
use App\Services\CampaignService;
use App\Services\VideoService;
use App\Http\Controllers\Controller;
use App\Services\PhotoService;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use App\UserDetail;
use DateTime;
use Storage;
use Auth;
use File;

class CampaignsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Campaigns Controller
    |--------------------------------------------------------------------------
    |
    |  This controller handles the registration of new campaign as well as
    |  validation and creation, launch, overview
    |
     */

    /**
     * @var FinancialInformation
     */
    private $financialinformation;

    /**
     * @var CampaignService
     */
	private $campaignService;

	private $photoService;

	private $videoService;

	private $campaign;

    private $category;

    private $contribution;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct(CampaignService $campaignService, FinancialInformation $financialinformation, Campaign $campaign ,PhotoService $photoService, VideoService $videoService, Category $category, Contribution $contribution) {
		$this->campaignService = $campaignService;
		$this->photoService = $photoService;
        $this->videoService = $videoService;
        $this->contribution = $contribution;
		$this->campaign = $campaign;
        $this->category = $category;
        $this->financialinformation = $financialinformation;

	}

    /**
     * @param integer $id
     * @param integer $tabId
     * @return mixed
     */
	public function show($id, $tabId = 1) {
		$campaign = $this->campaign->find($id);
		if ($campaign->delete_flag == 1 || $campaign->status == 0 || $campaign->status == 2) {
			return redirect('')->with("error","Dự án đã bị xoá hoặc không tồn tại, vui lòng xem các dự án khác.");
		}
		$author = $campaign->user()->get();
		$backers = $campaign->getBackerList();
		$photos = $campaign->photos()->get();
		$videos = $campaign->videos()->get();
        $perks = $campaign->perks()->where('delete_flag', 0)->orderBy('price', 'ASC')->get();
		$comments = $campaign->comments()->orderBy('created_at', 'DESC')->get();
		$isExpired = $campaign->checkExpired();
		return view('campaigns.project', compact('campaign', 'photos', 'perks', 'backers', 'author', 'comments', 'tabId', 'videos', 'isExpired'));

	}

    /**
     * @return mixed
     */
	public function create(){
		return view('/campaigns/create');
	}

    /**
     * @param Request $request
     * @return mixed
     */
	public function store(Request $request){
		$request->validate([
			'goal' => 'required',
			'title' => 'required',
		]);
		$campaign = $this->campaignService->create($request);
		return redirect()->route('basic', ['id' => $campaign->id]);
	}

    /**
     * @param $id
     * @return mixed
     */
	public function basic($id){
		$campaign = $this->campaign->find($id);
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}
		$categories = $this->category->all();
		$tags = $campaign->tags()->pluck('title');
		$tag = '';
		foreach($tags as $tagg[]){
			$tag = implode(", ",$tagg);
		}
		return view('/campaigns/basic')->with('id',$campaign->id)
			->with('title',$campaign->title)
			->with('img',$campaign->avatar)
			->with('tagline',$campaign->tagline)
			->with('location',$campaign->location)
			->with('categori',$campaign->category_id)
			->with('tag',$tag)
			->with('categories',$categories)
			->with('duration',$campaign->duration)
			->with('alert', 0);
	}

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
	public function basicStore(Request $request, $id){
		$request->validate([
			'title' => 'required',
			'categories' => 'required',
			'duration' => 'required|max:255',
		]);
		$this->campaignService->makeBasic($request, $id);
		return redirect()->route('story', ['id' => $id]);
	}

    /**
     * @param $id
     * @return mixed
     */
	public function story($id)
	{
		$campaign = $this->campaign->find($id);
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}
		$video = $this->videoService->getVideo($id); 
		$photo = $this->photoService->getPhoto($id);
		return view('/campaigns/story')->with('id',$campaign->id)
			->with('title',$campaign->title)
			->with('videos',$video)
			->with('img',$photo)
			->with('pitch',$campaign->pitch)
			->with('imgs',$campaign->avatar)
			->with('alert', 0);
	}

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
	public function storyStore(Request $request, $id)
	{
		$campaign = $this->campaign->find($id);
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
        }
        $this->photoService->make($request,$id);
		$campaign->pitch = $request->pitch;
		$campaign->save();
		return redirect()->route('perk', ['id' => $id]);
	}

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
	public function videoStore(Request $request, $id)
	{   
		$this->videoService->make($request, $id);
		return back();
	}

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
	public function launchCampaign(Request $request, $id)
	{
		$campaign = $this->campaign->find($id);
		$currenttime = new DateTime();
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}
        $financial = $this->financialinformation->findWhere([['campaign_id','=' ,$id]])->first();
        $photo = $this->photoService->checkPhoto($id);
        $video = $this->videoService->checkVideo($id);
        $perk = $this->campaignService->getPerk($id);
		if(!$campaign->avatar || !$campaign->duration){
			$categories = $this->category->all();
			$tags = $campaign->tags()->pluck('title');
			$tag = '';
			foreach($tags as $tagg[]){
				$tag = implode(", ",$tagg);
			}
			return redirect('/basic/'.$id)->with('alert', 'Không Được Để Trống Avatar.');
        }else if(!$photo && !$video){
				return redirect('/story/'.$id)->with('alert', 'Bạn phải có ít nhất 1 ảnh hoặc video');
		}else if(!$financial){
			return redirect('/financialInformation/'.$id)->with('alert', 'Bạn Phải Điền Đầy Đủ Thông Tin Tài Chính');
		}else if(!$perk){
				return redirect('/perk/'.$id)->with('alert', 'Bạn phải tạo ít nhất 1 gói đầu tư.');
		}else if(!$campaign->start_at){
			$campaign->start_at = $currenttime;
		}
		if($campaign->status == 0){
			$campaign->end_at = $currenttime->modify('+'.$campaign->duration.'day');
		}
		$campaign->status = 1;
		$campaign->save();
        return redirect('/campaigns/'.$id);
    }

    /**
     * @param $id
     * @return mixed
     */
	public function overView($id) {
		$campaign = $this->campaign->find($id);
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}
		$perk = $this->perk->findWhere([['campaign_id' ,'=' ,$id]])->first();
		if(!$perk){
			return redirect('/campaigns/perk/'.$id)->with('alert', 'Bạn phải tạo ít nhất 1 gói đầu tư.');
		}
		$author = $campaign->user()->get();
		$backers = $campaign->getBackerList();
		$videos = $campaign->videos()->get();
		$photos = $campaign->photos()->get();
		$perks = $campaign->perks()->where('delete_flag', 0)->orderBy('price', 'ASC')->get();
		return view('/campaigns/overview', compact('campaign', 'photos', 'videos', 'perks', 'backers', 'author'));
	}

    /**
     * @param $id
     * @return mixed
     */
	public function investerList($id)
	{
		$campaign = $this->campaign->find($id);
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}
		$contributions = $this->contribution->findWhere([['campaign_id' ,'=' ,$id]]);
		return view('/campaigns/investerlist', compact('contributions','campaign'));
	}
}
