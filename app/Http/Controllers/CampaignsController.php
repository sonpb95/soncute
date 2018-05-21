<?php

namespace App\Http\Controllers;

use App\Repositories\ContributionRepository as Contribution;
use App\Repositories\CampaignRepository as Campaign;
use App\Repositories\CategoryRepository as Category;
use App\Repositories\FollowRepository as Follow;
use App\Repositories\VideoRepository as Video;
use App\Repositories\PhotoRepository as Photo;
use App\Repositories\PerkRepository as Perk;
use App\Repositories\ItemRepository as Item;
use App\Repositories\TagRepository as Tag;
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
    protected $campaign;

    protected $tag;

    protected $item;

    protected $perk;

    protected $video;

    protected $photo;

    protected $category;

    protected $contribution;

    protected $follow;

    public function __construct(Campaign $campaign, Tag $tag, Item $item, Perk $perk, Video $video, Photo $photo, Category $category, Contribution $contribution, Follow $follow) {
        $this->campaign = $campaign;
        $this->tag = $tag;
	    $this->item = $item;
        $this->perk = $perk;
        $this->video = $video;
        $this->photo = $photo;
        $this->category = $category;
        $this->contribution = $contribution;
        $this->follow = $follow;
    }

	public function show($id, $tabId = 1) {
		$campaign = $this->campaign->find($id);
		if ($campaign->delete_flag == 1 || $campaign->status == 0 || $campaign->status == 2) {
			return redirect()->back()->with("error","Dự án đã bị xoá hoặc không tồn tại, vui lòng xem các dự án khác.");
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

	public function follow($id) {
		$campaign = $this->campaign->find($id);
		if (Auth::check()) {
			$follow = Auth::user()->follows()->where('campaign_id', $campaign->id)->first();
			if(is_null($follow)) {
                $follow = $this->follow->create([
                    'user_id' => Auth::id(),
                    'campaign_id' => $campaign->id,
                    ]);
				return 'followed';
			} else {
				$follow->delete();
				return 'unfollowed';
			}
		}
	}

	public function create(){
		return view('/campaigns/create');
	}

	public function store(Request $request){
			$request->validate([
				'goal' => 'required',
				'title' => 'required',

			]);
			$now = new DateTime();
			$data = $this->campaign->create([
				'user_id' => Auth::id(),
				'goal' => str_replace(',', '', request('goal')),
				'title' => request('title'),
				'end_at' => $now->modify('+ 60 day'),
			]);
			if($data){
				return redirect()->route('basic', ['id' => $data->id]);
			}
	}

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

	public function basicstore(Request $request, $id){
		$request->validate([
			'title' => 'required',
			'categories' => 'required',
			'duration' => 'required|max:255',
		]);
		$campaign = $this->campaign->find($id);
		$campaign->priority = $id;
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}
		$title = request('title');
		$img = "";
		if($request->hasFile('img')){
			$destinationPath="img";
			$file = $request->img;
			$extension=$file->getClientOriginalExtension();
			$fileName = rand(1010,9999).".".$extension;
			$file->move($destinationPath,$fileName);
			$img = $fileName;
		}
		$campaign->title = $request->title;
		$campaign->tagline = $request->tagline;
		$campaign->location =  $request->location;
		$campaign->category_id = $request->categories;
		$campaign->duration = $request->duration;
		if(!$img == ""){
			$campaign->avatar = $img;
		}
		$campaign->save();
		$string = $request->tags;
		$token = strtok($string, ", ");
		while ($token !== false)
		   {
			$tag = $this->tag->create([
			'title' => $token,
			]);
			$campaign->tags()->attach($tag->id);
		   $token = strtok(", ");
		   }
	return redirect()->route('story', ['id' => $id]);
	}
	public function story($id)
	{
	//$id = $request->query('id');
	$campaign = $this->campaign->find($id);
	if($campaign->user_id != Auth::id())
	{
		return redirect('');
	}
	try {
	  $video = $this->video->findWhere([['campaign_id' ,'=' ,$id]])->first()->link;
	}
	catch (\Exception $e) {
		$video = '';
	}
	try {
        $photo = $this->photo->findWhere([['campaign_id' ,'=' ,$id]])->first()->link;
	}
	catch (\Exception $e) {
		$photo = 'defaultimage.png';
	}
	return view('/campaigns/story')->with('id',$campaign->id)
								   ->with('title',$campaign->title)
								   ->with('videos',$video)
								   ->with('img',$photo)
								   ->with('pitch',$campaign->pitch)
								   ->with('imgs',$campaign->avatar)
								   ->with('alert', 0);
	}

	public function storystore(Request $request, $id)
	{
	$campaign = $this->campaign->find($id);
	if($campaign->user_id != Auth::id())
	{
		return redirect('');
	}
	$img = "";
	if($request->hasFile('img')){
		$destinationPath="img";
		$file = $request->img;
		$extension=$file->getClientOriginalExtension();
		$fileName = rand(1010,9999).".".$extension;
		$file->move($destinationPath,$fileName);
		$img = $fileName;
	}
    if(!$img == ""){
        $this->photo->create([
            'campaign_id' => $id,
            'link' => $img,
        ]);
	}
	$detail=$request->pitch;
	$campaign->pitch = $detail;
	$campaign->save();
		return redirect()->route('perk', ['id' => $id]);
	}

	public function videostore(Request $request, $id)
	{
        $video = $this->video->create([
            'campaign_id' => $id,
            'link' => str_replace("watch?v=","embed/",$request->video )
        ]);
	return back();
	}

	public function launchcampaign(Request $request, $id)
	{
		$campaign = $this->campaign->find($id);
		$currenttime = new DateTime();
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}
		$financial = $this->financialinformation->findWhere([['campaign_id','=' ,$id]])->first();
		//0 = invisible
		//1 = visible
		$photo = $this->photo->findWhere([['campaign_id' ,'=' ,$id]])->first();
		$video = $this->video->findWhere([['campaign_id' ,'=' ,$id]])->first();
		$perk = $this->perk->findWhere([['campaign_id' ,'=' ,$id]])->first();
		if(!$campaign->avatar || !$campaign->duration){
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
										   ->with('alert', 1);
		}else if(!$photo && !$video){
			try {
			  $video = $this->video->findWhere('campaign_id', $id)->latest()->first()->link;
			}
			catch (\Exception $e) {
				$video = '';
			}
			try {
			  $photo = $this->photo->findWhere('campaign_id', $id)->latest()->first()->link;
			}
			catch (\Exception $e) {
				$photo = '';
			}
			return view('/campaigns/story')->with('id',$campaign->id)
										   ->with('title',$campaign->title)
										   ->with('videos',$video)
										   ->with('img',$photo)
										   ->with('pitch',$campaign->pitch)
										   ->with('imgs',$campaign->avatar)
										   ->with('alert', 1);
		}else if(!$financial){
			$account_number = '';
			$account_name = '';
			$bank_name = '';
			$branch = '';
			return view('/campaigns/financialInformation')->with('id',$campaign->id)
									   ->with('title',$campaign->title)
									   ->with('account_number',$account_number)
									   ->with('account_name',$account_name)
									   ->with('bank_name',$bank_name)
									   ->with('branch',$branch)
									   ->with('img',$campaign->avatar)
									   ->with('alert', 1);
		}else if(!$perk){
		$perks = $this->perk->with('items')->where([['campaign_id', '=', $id],['delete_flag', '=', 0]])->get();
		return view('/campaigns/perk')->with('id',$campaign->id)
									  ->with('title',$campaign->title)
									  ->with('perks',$perks)
									  ->with('img',$campaign->avatar)
									   ->with('alert', 1);
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

	public function overview($id) {
		$campaign = $this->campaign->find($id);
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}
		$perk = $this->perk->findWhere([['campaign_id' ,'=' ,$id]])->first();
		if(!$perk){
		$perks = $this->perk->with('items')->where([['campaign_id', '=', $id],['delete_flag', '=', 0]]);
		return view('/campaigns/perk')->with('id',$campaign->id)
									  ->with('title',$campaign->title)
									  ->with('perks',$perks)
									  ->with('img',$campaign->avatar)
									   ->with('alert', 1);
		}
		$author = $campaign->user()->get();
		$backers = $campaign->getBackerList();
		$videos = $campaign->videos()->get();
		$photos = $campaign->photos()->get();
		$perks = $campaign->perks()->where('delete_flag', 0)->orderBy('price', 'ASC')->get();
		return view('/campaigns/overview', compact('campaign', 'photos', 'videos', 'perks', 'backers', 'author'));
	}

	public function investerlist($id)
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
