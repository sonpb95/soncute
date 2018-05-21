<?php
namespace App\Http\Controllers;
use App\Repositories\CampaignRepository as Campaign;
use App\Repositories\ItemRepository as Item;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use DateTime;
use Storage;
use Auth;


class ItemController extends Controller
{
	protected $campaign;
	
	protected $item;
	
	public function __construct(Campaign $campaign, Item $item) {

        $this->campaign = $campaign;
	    $this->item = $item;

    }
	
	public function item($id)
	{
	$campaign = $this->campaign->find($id);
	if($campaign->user_id != Auth::id())
	{
		return redirect('');
	}
	$items = $this->item->with('perks')->findWhere([['campaign_id', '=', $id],['delete_flag', '=', 0]]);

	return view('/campaigns/item')->with('id',$campaign->id)
									->with('title',$campaign->title)
									->with('img',$campaign->avatar)
									->with('items',$items);
	}

	public function itemcreate($id)
	{
		$campaign = $this->campaign->find($id);
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}

		return view('/campaigns/itemcreate')->with('id',$campaign->id)
										->with('title',$campaign->title)
										->with('img',$campaign->avatar);
	}

	public function itemstore(Request $request, $id)
	{
		$request->validate([
			'item_name' => 'required|max:255',

		]);
	
		$item = $this->item->makeModel();
		$item->campaign_id = $id;
		$item->item_name = $request->item_name;
		$item->option_name = $request->option_name;
		$item->option_value = $request->option_value;
		$item->save();
		return redirect()->route('item', ['id' => $id]);
	}

	public function itemedit(Request $request, $id)
	{
		$items = $this->item->find($id);
		$campaign = $this->campaign->find($items->campaign_id);
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}

		return view('/campaigns/itemedit')->with('id',$campaign->id)
											->with('title',$campaign->title)
											->with('items',$items)
											->with('img',$campaign->avatar);
	}

	public function itemupdate(Request $request, $id)
	{
		$request->validate([
			'item_name' => 'required|max:255',

		]);
		$item = $this->item->find($id);
		$item->item_name = $request->item_name;
		$item->option_name = $request->option_name;
		$item->option_value = $request->option_value;
		$item->save();
		$campaign = $this->campaign->find($item->campaign_id);
		$items = $this->item->with('perks')->findWhere([['campaign_id' ,'=' ,$item->campaign_id]]);

		return view('/campaigns/item')->with('id',$campaign->id)
									  ->with('title',$campaign->title)
									  ->with('items',$items)
									  ->with('img',$campaign->avatar);
	}

	public function itemdelete($id)
	{
		$item = $this->item->find($id);
		$campaign = $this->campaign->find($item->campaign_id);
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}
		$item->delete_flag = 1;
		$item->save();

		return back();
	}
	
}