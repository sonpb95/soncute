<?php
namespace App\Http\Controllers;
use App\Repositories\ReportCampaignRepository as ReportCampaign;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use App\UserDetail;
use DateTime;
use Storage;
use Auth;


class ReportController extends Controller
{
	protected $reportcampaign;
	
	public function __construct(ReportCampaign $reportcampaign) {
		$this->reportcampaign = $reportcampaign;
	}
	
	public function reportCampaign(Request $request, $id)
	{
		$userid = Auth::id();
		return view('/campaigns/reportCampaign')->with('userid',$userid);
	}

	public function reportSent(Request $request, $id)
	{
		$report = $this->reportcampaign->makeModel();
		$report->campaign_id = request()->route('id');
		$report->user_id = Auth::id();
		$report->reason = $request->reason;
		$report->save();

		return redirect('/campaigns/'.$id)->with("success","Report được gửi thành công !");
	}

	public function reportView(Request $request, $id)
	{
	/* if(!UserDetail::where([['is_admin' ,'=' ,1],['user_id','=' , Auth::id()]])->first()){
		$report = ReportCampaign::where(['campaign_id',$id])->latest()->first();
		return redirect('');
	} */
		$userid = Auth::id();
		$report = $this->reportcampaign->findWhere([['campaign_id',$id],['user_id',$userid]])->latest()->first();
		if(!$report){
			return redirect('');
		}
		return view('/campaigns/reportView')->with('report',$report);
	}

	public function reportmanager($id)
	{
		if(!UserDetail::where([['is_admin' ,'=' ,1],['user_id','=' , Auth::id()]])->first()){
			return redirect('');
		}
		$reports = $this->reportcampaign->findWhere([['campaign_id' ,'=' ,$id]]);
		return view('/campaigns/reportmanager')->with('reports',$reports);
	}

	public function reportViewByAdmin(Request $request, $id)
	{
		if(!UserDetail::where([['is_admin' ,'=' ,1],['user_id','=' , Auth::id()]])->first()){
			$report = $this->reportcampaign->findWhere([['campaign_id' ,'=' ,$id]])->latest()->first();
			return redirect('');
		}
		$report = $this->reportcampaign->find($id);


		return view('/campaigns/reportView')->with('report',$report);
	}
}