<?php

namespace App\Http\Controllers;

use App\Repositories\ReportCampaignRepository as ReportCampaign;
use App\Repositories\CampaignRepository as Campaign;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use App\Mail\Notification;
use App\Mail\Warning;
use App\UserDetail;
use DateTime;
use Storage;
use Auth;
use File;


class AdminController extends Controller
{	
	
	protected $campaign;
	
	protected $reportCampaign;
	
	public function __construct(Campaign $campaign, ReportCampaign $reportCampaign) {

        $this->campaign = $campaign;
		$this->reportCampaign = $reportCampaign;
		
       

    }
	
	public function campaignManager()
	{
		if(!UserDetail::where([['is_admin' ,'=' ,1],['user_id','=' , Auth::id()]])->first()){
			return redirect('');
		}
		$currenttime = new DateTime();
        $prepair_campaigns = $this->campaign->findWhere([['status', '=', '0'], ['delete_flag', '=', '0']]);
        $campaigns = $this->campaign->findWhere([['status', '=', '1'], ['delete_flag', '=', '0']]);
		$end_campaigns = $this->campaign->findWhere([['end_at', '<=', $currenttime], ['delete_flag', '=', '0']]);
        $report_campaigns = $this->reportCampaign->getReportedCampaign();
		$stopped_campaigns = $this->campaign->findWhere([['status', '=', '2'], ['delete_flag', '=', '0']]);
		$cancel_campaigns = $this->campaign->findWhere([['delete_flag', '=', '1']]);
		// se bi loi Trying to get property of non-object neu co gia tri null
		 /* status :
				0 = invisible
				1 = visible
				2 = houlding
				*/
		return view('/campaigns/campaignmanager')->with('prepair_campaigns',$prepair_campaigns)
												 ->with('campaigns',$campaigns)
												 ->with('end_campaigns',$end_campaigns)
												 ->with('report_campaigns',$report_campaigns)
												 ->with('stopped_campaigns',$stopped_campaigns)
												 ->with('cancel_campaigns',$cancel_campaigns);
	}
	
	public function stopCampaign($id)
	{
		if(!UserDetail::where([['is_admin' ,'=' ,1],['user_id','=' , Auth::id()]])->first()){
			return redirect('');
		}
		$campaign = $this->campaign->find($id);
		$campaign->status = 2;
		$campaign->save();
		\Mail::to($campaign->user)->send(new Warning($campaign));
		foreach($campaign->getBackerList() as $backer){
			if(get_class($backer) == 'App\User'){
				\Mail::to($backer)->send(new Notification($campaign,$backer));
			}
		}
		return back();
	}

	public function runCampaign($id)
	{
		if(!UserDetail::where([['is_admin' ,'=' ,1],['user_id','=' , Auth::id()]])->first()){
			return redirect('');
		}
		$campaign = $this->campaign->find($id);
		$campaign->status = 1;
		$campaign->save();
		return back();
	}

	public function deleteCampaign($id)
	{
		if(!UserDetail::where([['is_admin' ,'=' ,1],['user_id','=' , Auth::id()]])->first()){
			return redirect('');
		}
		$campaign = $this->campaign->find($id);
		$campaign->delete_flag = 1;
		$campaign->save();
		return back();
	}
	
}
