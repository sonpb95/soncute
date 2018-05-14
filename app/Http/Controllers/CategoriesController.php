<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Campaign;
use Helper;
use DB;

class CategoriesController extends Controller
{
  public function getCampaigns(Category $category) {
    $campaigns = '';
    $lastPriority = '';
    $campaignsCount = $category->getCampaignCount();
    if ($campaignsCount > 0) {
      if ($campaignsCount < 12) {
        $campaigns = $category->campaigns()->orderBy(DB::raw('-`priority`'), 'desc')->where('delete_flag', '0')->where('status', '!=', '0')->get();
        if ($campaigns != '') {
          if ($campaignsCount >= 1) {
            $lastPriority = $campaigns->get($campaigns->count() - 1)->priority;
          } else {
            $lastPriority = $campaigns->get(0)->priority; // get fewest priority
          }
        }
      } else {
        $campaigns = $category->campaigns()->orderBy(DB::raw('-`priority`'), 'desc')->where('delete_flag', '0')->where('status', '!=', '0')->take(12)->get();
        $lastPriority = $campaigns->get(11)->priority; // get fewest priority
      }
    }
    return ['campaigns' => $campaigns, 'lastPriority' => $lastPriority];
  }

  public function show(Category $category) {
    $categoryDetail = $this->getCampaigns($category);
    $campaigns = $categoryDetail['campaigns'];
    $lastPriority = $categoryDetail['lastPriority'];
    $allCategory = Category::all();
    return view('campaigns.category', compact('category', 'campaigns', 'allCategory','lastPriority'));
  }

  public function discover() {
    $category = new Category;
    $category->id = 0;
    $category->name = 'Khám phá';
    $allCategory = Category::all();
    $campaigns = Campaign::orderBy(DB::raw('-`priority`'), 'desc')->where('delete_flag', '0')->where('status', '!=', '0')->get();
    $lastPriority = 1;
    return view('campaigns.category', compact('category', 'campaigns', 'allCategory','lastPriority'));
  }

  public function nowLauched() {
    $category = new Category;
    $category->id = 0;
    $category->name = 'Now lauched';
    $allCategory = Category::all();
    $campaigns = Campaign::orderBy('start_at', 'ASC')->where('delete_flag', '0')->where('status', '!=', '0')->get();
    $lastPriority = 1;
    return view('campaigns.category', compact('category', 'campaigns', 'allCategory','lastPriority'));
  }

  public function endingSoon() {
    $category = new Category;
    $category->id = 0;
    $category->name = 'Ending soon';
    $allCategory = Category::all();
    $campaigns = Campaign::orderBy('end_at', 'ASC')->where('delete_flag', '0')->where('status', '!=', '0')->get();
    $lastPriority = 1;
    return view('campaigns.category', compact('category', 'campaigns', 'allCategory','lastPriority'));
  }

  public function smallGoal() {
    $category = new Category;
    $category->id = 0;
    $category->name = 'Small project';
    $allCategory = Category::all();
    $campaigns = Campaign::orderBy('goal', 'ASC')->where('delete_flag', '0')->where('status', '!=', '0')->get();
    $lastPriority = 1;
    return view('campaigns.category', compact('category', 'campaigns', 'allCategory','lastPriority'));
  }

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
