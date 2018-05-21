<?php
namespace App\Http\Controllers;
use App\Repositories\CampaignRepository as Campaign;
use App\Repositories\PerkRepository as Perk;
use App\Repositories\ItemRepository as Item;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use DateTime;
use Storage;
use Auth;


class PerkController extends Controller
{
	protected $campaign;
	
	protected $perk;
	
	protected $item;
	
	public function __construct(Campaign $campaign, Item $item, Perk $perk) {

        $this->campaign = $campaign;
	    $this->item = $item;
        $this->perk = $perk;

    }
	
	public function perk($id)
	{
		$campaign = $this->campaign->find($id);
		
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}
		$perks = $this->perk->with('items')->findWhere([['campaign_id', '=', $id],['delete_flag', '=', 0]]);
		return view('/campaigns/perk')->with('id',$campaign->id)
									  ->with('title',$campaign->title)
									  ->with('img',$campaign->avatar)
									  ->with('perks',$perks)
									  ->with('alert', 0);
	}

	public function perkcreate(Request $request, $id)
	{
		$campaign = $this->campaign->find($id);
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}
		$items = $this->item->findWhere([['campaign_id', '=', $id]]);

		return view('/campaigns/perkcreate')->with('id',$campaign->id)
											->with('title',$campaign->title)
											->with('imgs',$campaign->avatar)
											->with('items',$items);
	}



	public function perkstore(Request $request, $id)
	{
		$request->validate([
			'price' => 'required|max:255',
			'retailprice' => 'max:255',
			'title' => 'required',

		]);
		$time = request('estimated_delivery_date');

		$newformat = date('Y-m-d', strtotime(str_replace('-','/', $time)));

		$img = "";
		if($request->hasFile('img')){
			$destinationPath="img";
			$file = $request->img;
			$extension=$file->getClientOriginalExtension();
			$fileName = rand(1010,9999).".".$extension;
			$file->move($destinationPath,$fileName);
			$img = $fileName;

		}

		$perk = $this->perk->makeModel();
		$count = $request->included_item;
		$perk->campaign_id = $id;
		$perk->price = str_replace(',', '', request('price'));

		if(request('retailprice') != ''){
			$perk->retail_price =  str_replace(',', '', request('retailprice'));
		}
		$perk->title = request('title');
		$perk->description = request('description');
		$perk->perk_image = $img;
		$perk->total_quantily = request('total_quantily');
		$perk->estimated_delivery_date = $newformat;
		$perk->ship = request('radio1');
		$perk->save();
		if($request->included_item != NULL){
			foreach($count as $i){
				$perk->items()->attach($i);
			}
		}
		return redirect()->route('perk', ['id' => $id]);
	}

	public function perkedit(Request $request, $id)
	{
		$perks = $this->perk->find($id);
		$campaign = $this->campaign->find($perks->campaign_id);
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}

		$items = $this->item->findWhere([['campaign_id' ,'=' ,$perks->campaign_id]]);

		return view('/campaigns/perkedit')->with('id',$campaign->id)
											->with('title',$campaign->title)
											->with('imgs',$campaign->avatar)
											->with('items',$items)
											->with('price',$perks->price)
											->with('retail_price',$perks->retail_price)
											->with('title',$perks->title)
											->with('description',$perks->description)
											->with('img',$perks->perk_image)
											->with('total_quantily',$perks->total_quantily)
											->with('edd',$perks->estimated_delivery_date)
											->with('ship',$perks->ship);
	}

	public function perkupdate(Request $request, $id)
	{
		$request->validate([
			'price' => 'required|max:255',
			'retailprice' => 'required|max:255',
			'title' => 'required',

		]);
		$perk = $this->perk->find($id);
		$count = $request->included_item;
		$time = request('estimated_delivery_date');

		$newformat = date('Y-m-d', strtotime(str_replace('-','/', $time)));

		$img = "";
		if($request->hasFile('img')){
			$destinationPath="img";
			$file = $request->img;
			$extension=$file->getClientOriginalExtension();
			$fileName = rand(1010,9999).".".$extension;
			$file->move($destinationPath,$fileName);
			$img = $fileName;

		}



		$perk->price = request('price');
		$perk->retail_price =  request('retailprice');
		$perk->title = request('title');
		$perk->description = request('description');
		if(!$img == ""){

			$perk->perk_image = $img;

		}

		$perk->total_quantily = request('total_quantily');
		$perk->estimated_delivery_date = $newformat;
		$perk->ship = request('radio1');

		$perk->save();
		if($request->included_item != NULL){
			foreach($count as $i){
			$perk->items()->attach($i);
			}
		}
		 return redirect()->route('perk', ['id' => $perk->campaign_id]);
	}

	public function perkdelete($id)
	{
		$perk = $this->perk->find($id);
		$campaign = $this->campaign->find($perk->campaign_id);
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}
		$perk->delete_flag = 1;
		$perk->save();

		return back();
	}
}