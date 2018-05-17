<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;

use App\Repositories\CampaignRepository as Campaign;
use App\Repositories\CommentRepository as Comment;
use Auth;

class CommentController extends Controller
{
	protected $comment;
	
	protected $campaign;

    public function __construct(Comment $comment, Campaign $campaign) {

        $this->comment = $comment;
		$this->campaign = $campaign;
    }
	
	public function comment(Request $request, $id)
	{
		$request->validate([
			'comment' => 'required',
		]);
		if(!Auth::id()){
			return redirect('/login')->with("failed","Bạn cần đăng nhập để thực hiện chức năng này !");
        }
        	$this->comment->create([
				'user_id' => Auth::id(),
				'campaign_id' => $id,
				'text' => request('comment')
			]);
			$campaign = $this->campaign->find($id);
			$author = $campaign->user()->get();
			$backers = $campaign->getBackerList();
			$photos = $campaign->photos()->get();
			$perks = $campaign->perks()->orderBy('price', 'ASC')->get();
			$comments = $this->comment->findWhere([['campaign_id' ,'=' ,$campaign->id]]);
			$videos = $campaign->videos()->get();
		    $tabId = 4;
			$isExpired = $campaign->checkExpired($campaign);
		  return view('campaigns.project', compact('campaign', 'photos', 'perks', 'backers', 'author', 'comments', 'tabId', 'videos', 'isExpired'));
	}
	
}