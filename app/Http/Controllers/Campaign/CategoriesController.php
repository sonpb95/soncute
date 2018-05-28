<?php

	namespace App\Http\Controllers\Campaign;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository as Category;
use App\Repositories\CampaignRepository as Campaign;
use Helper;
use DB;

class CategoriesController extends Controller
{
    /**
     * @var Campaign
     */
	protected $campaign;

    /**
     * @var Category
     */
	protected $category;

    /**
     * CategoriesController constructor.
     * @param Campaign $campaign
     * @param Category $category
     */
	public function __construct(Campaign $campaign, Category $category) {

		$this->campaign = $campaign;
		$this->category = $category;

	}

    /**
     * @return mixed
     */
	public function categorymanager()
	{
		$categories = $this->category->all();
		return view('/campaigns/categorymanager')->with('categories',$categories);
	}

    /**
     * @param Request $request
     * @return mixed
     */
	public function addcategory(Request $request)
	{
		$this->category->create([
			'name' => request('name'),
		]);
		return back();
	}

    /**
     * @param $id
     * @return mixed
     */
	public function editcategory($id)
	{
		$category = $this->category->find($id);
		return view('/campaigns/editcategory')->with('category',$category->name)
			->with('id',$category->id);
	}

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
	public function updatecategory(Request $request, $id)
	{
		$category = $this->category->find($id);
		$category->name = request('name');
		$category->save();
		return redirect('categorymanager');
	}

    /**
     * @param $id
     * @return array
     */
	public function getCampaigns($id) {
		$campaigns = '';
		$lastPriority = '';
		$categories = $this->category->find($id);
		$campaignsCount = $categories->getCampaignCount();
		if ($campaignsCount > 0) {
			if ($campaignsCount < 12) {
				$campaigns = $categories->campaigns()->orderBy(DB::raw('-`priority`'), 'desc')->where('delete_flag', '0')->where('status', '!=', '0')->get();
				if ($campaigns != '') {
					if ($campaignsCount >= 1) {
						$lastPriority = $campaigns->get($campaigns->count() - 1)->priority;
					} else {
						$lastPriority = $campaigns->get(0)->priority; // get fewest priority
					}
				}
			} else {
				$campaigns = $category->campaigns()->orderBy(DB::raw('-`priority`'), 'desc')->where([['delete_flag', '0'], ['status', '!=', '0']])->take(12)->get();
				$lastPriority = $campaigns->get(11)->priority; // get fewest priority
			}
		}
		return ['campaigns' => $campaigns, 'lastPriority' => $lastPriority];
	}

    /**
     * @param $id
     * @return mixed
     */
	public function show($id) {
		$categoryDetail = $this->getCampaigns($id);
		$campaigns = $categoryDetail['campaigns'];
		$lastPriority = $categoryDetail['lastPriority'];
		$allCategory = $this->category->all();
		$categories = $this->category->find($id);
		return view('campaigns.category', compact('categories', 'campaigns', 'allCategory','lastPriority'));
	}

    /**
     * @return mixed
     */
	public function discover() {
		$categories = $this->category->makeModel();
		$categories->id = 0;
		$categories->name = 'Khám phá';
		$allCategory = $this->category->all();
		$campaigns = $this->campaign->orderBy(DB::raw('-`priority`'), 'desc')->where('delete_flag', '0')->where('status', '!=', '0')->get();
		$lastPriority = 1;
		return view('campaigns.category', compact('categories', 'campaigns', 'allCategory','lastPriority'));
	}

    /**
     * @return mixed
     */
	public function nowLauched() {
		$category = new Category;
		$category->id = 0;
		$category->name = 'Now lauched';
		$allCategory = Category::all();
		$campaigns = Campaign::orderBy('start_at', 'ASC')->where('delete_flag', '0')->where('status', '!=', '0')->get();
		$lastPriority = 1;
		return view('campaigns.category', compact('category', 'campaigns', 'allCategory','lastPriority'));
	}

    /**
     * @return mixed
     */
	public function endingSoon() {
		$category = new Category;
		$category->id = 0;
		$category->name = 'Ending soon';
		$allCategory = Category::all();
		$campaigns = Campaign::orderBy('end_at', 'ASC')->where('delete_flag', '0')->where('status', '!=', '0')->get();
		$lastPriority = 1;
		return view('campaigns.category', compact('category', 'campaigns', 'allCategory','lastPriority'));
	}

    /**
     * @return mixed
     */
	public function smallGoal() {
		$category = new Category;
		$category->id = 0;
		$category->name = 'Small project';
		$allCategory = Category::all();
		$campaigns = Campaign::orderBy('goal', 'ASC')->where('delete_flag', '0')->where('status', '!=', '0')->get();
		$lastPriority = 1;
		return view('campaigns.category', compact('category', 'campaigns', 'allCategory','lastPriority'));
	}

    /**
     * @param $lastPriority
     * @param $categoryId
     * @return string
     */
	public function loadMoreCampaign($lastPriority, $categoryId) {
		$output = '';
		$campaigns = '';

		if ($categoryId > 0) {
			$category = Category::find($categoryId);
		}

		/*if ($categoryId == 0){ //discover
			  $campaigns = Campaign::where([['priority', '>', $lastPriority],['delete_flag', '=', 0]])->orderBy('priority', 'ASC')->take(12)->get();
			} else if ($categoryId == -1) {//now Lauched
			  $campaigns = Campaign::where([['priority', '>', $lastPriority],['delete_flag', '=', 0]])->orderBy('start_at', 'ASC')->take(12)->get();
			} else if ($categoryId == -2){ // ending soon
			  $campaigns = Campaign::where([['priority', '>', $lastPriority],['delete_flag', '=', 0]])->orderBy('end_at', 'DESC')->take(12)->get();
			} else if ($categoryId == -3){ // snall goal
			  $campaigns = Campaign::where([['priority', '>', $lastPriority],['delete_flag', '=', 0]])->orderBy('goal', 'DESC')->take(12)->get();
			} else { // default categories
			  $campaigns = $category->campaigns()->where([['priority', '>', $lastPriority],['delete_flag', '=', 0]])->orderBy('priority', 'ASC')->take(12)->get();
			}*/
		$campaigns = $category->campaigns()->where([['priority', '>', $lastPriority], ['delete_flag', '0'], ['status', '!=', '0']])->orderBy(DB::raw('-`priority`'), 'desc')->get();

		if(!$campaigns->isEmpty())
		{
			$loop = 1;
			foreach($campaigns as $campaign)
			{
				$author = $campaign->user()->get();
				$output .=
					'<div class="grid_3">
						<div class="project-short sml-thumb">
							<div class="top-project-info">
								<div class="content-info-short clearfix">
									<a href="/campaigns/'.$campaign->id.'" class="thumb-img">
										<img src="'.asset('img/'.$campaign->avatar).'" alt="'.$campaign->title.'">
									</a>
									<div class="wrap-short-detail">
										<h3 class="rs acticle-title"><a class="be-fc-orange" href="/campaigns/'.$campaign->id.'">'.$campaign->title.'</a></h3>
										<p class="rs tiny-desc">by <a href="/users/'.$author[0]->id.'" class="fw-b fc-gray be-fc-orange">'.$author[0]->name.'</a></p>
										<p class="rs title-description">'.str_limit($campaign->tagline, 119, '...').'</p>
										<p class="rs project-location">
											<i class="icon iLocation"></i>'
					.$campaign->location.
					'</p>
									</div>
								</div>
							</div>
							<div class="bottom-project-info clearfix">
								<div class="line-progress">
									<div class="bg-progress">';
				if ($campaign->getPercents() >= 100){
					$output .='<span class="success" style="width: '.$campaign->getPercents().'%"></span>';
				} else {
					$output .='<span style="width: '.$campaign->getPercents().'%"></span>';
				}

				$output .='</div>
								</div>
								<div class="group-fee clearfix">
									<div class="fee-item">
										<p class="rs lbl">Tiến Độ</p>
										<span class="val">'.$campaign->getPercents().'%</span>
									</div>
									<div class="sep"></div>
									<div class="fee-item">
										<p class="rs lbl">Thu Được</p>
										<span class="val">'.$campaign->getFomattedFundRaised().'đ</span>
									</div>
									<div class="sep"></div>
									<div class="fee-item">
										<p class="rs lbl">Còn Lại</p>
										<span class="val">'.$campaign->getDayLeft().'ngày</span>
									</div>
								</div>
								<div class="clear"></div>
							</div>
						</div>
					</div><!--end: .grid_3 > .project-short-->';
				if ($loop % 3 == 0 ) {
					$output .='<div class="clear"></div>';
				};
				$loop += 1;
			}
		}
		return $output;
	}
}