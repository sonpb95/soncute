<?php
namespace App\Http\Controllers;
use App\Repositories\FinancialInformationRepository as FinancialInformation;
use App\Repositories\CampaignRepository as Campaign;
use App\Repositories\PerkRepository as Perk;
use App\Repositories\ItemRepository as Item;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use DateTime;
use Storage;
use Auth;


class FinancialInformationController extends Controller
{
	protected $campaign;
	
	protected $perk;
	
	protected $item;
	
	protected $financialinformation;
	
	public function __construct(Campaign $campaign, Item $item, Perk $perk, FinancialInformation $financialinformation) {

        $this->campaign = $campaign;
		$this->financialinformation = $financialinformation;
	    $this->item = $item;
        $this->perk = $perk;

    }
	
	public function financialInformation($id)
	{

		$campaign = $this->campaign->find($id);
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}
		$financial = $this->financialinformation->findWhere([['campaign_id' ,'=' ,$id]])->first();
		if(!$financial){
			$account_number = '';
			$account_name = '';
			$bank_name = '';
			$branch = '';
		}else{
			$account_number = $financial->account_number;
			$account_name = $financial->account_name;
			$bank_name = $financial->bank_name;
			$branch = $financial->branch;
		}
		return view('/campaigns/financialInformation')->with('id',$campaign->id)
									   ->with('title',$campaign->title)
									   ->with('account_number',$account_number)
									   ->with('account_name',$account_name)
									   ->with('bank_name',$bank_name)
									   ->with('branch',$branch)
									   ->with('img',$campaign->avatar)
									   ->with('alert', 0);
	}

	public function financialInformationstore(Request $request, $id)
	{
		$request->validate([
			'account_number' => 'required',
			'account_name' => 'required',
			'bank_name' => 'required',
			'branch' => 'required',
		]);

		$campaign = $this->campaign->find($id);
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
        }
        if(!$this->financialinformation->findWhere([['campaign_id' ,'=' ,$id]])){
            $financial = $this->financialinformation->makeModel(); 
        }else{
            $financial = $this->financialinformation->findWhere([['campaign_id' ,'=' ,$id]])->first();
        }
		$financial->campaign_id = $id;
		$financial->account_number = $request->account_number;
		$financial->account_name = $request->account_name;
		$financial->bank_name = $request->bank_name;
		$financial->branch = $request->branch;
		$financial->save();

		return redirect('financialInformation/'.$id)->with("success","Thông tin tài chính được thêm thành công !");
	}
	
}