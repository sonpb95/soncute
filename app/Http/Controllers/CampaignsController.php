<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use DateTime;
use App\Repositories\CampaignRepository as Campaign;
//use App\Campaign;
use App\Comment;
use App\UserDetail;
use App\Tag;
use App\Item;
use App\Perk;
use App\Video;
use App\Photo;
use App\Category;
use App\Contribution;
use App\FinancialInformation;
use App\ReportCampaign;
use App\Follow;
use App\Mail\Warning;
use App\Mail\Notification;
use Auth;
use File;
use Storage;


class CampaignsController extends Controller
{
    protected $campaign;

    public function __construct(Campaign $campaign) {

        $this->campaign = $campaign;
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
		//$isExpired = 'true';
		$isExpired = $campaign->checkExpired();

		return view('campaigns.project', compact('campaign', 'photos', 'perks', 'backers', 'author', 'comments', 'tabId', 'videos', 'isExpired'));
	}

	public function follow($id) {
		$campaign = $this->campaign->find($id);
		if (Auth::check()) {
			$follow = Auth::user()->follows()->where('campaign_id', $campaign->id)->first();
			if(is_null($follow)) {
				$follow = new Follow();
				$follow->user_id = Auth::id();
				$follow->campaign_id = $campaign->id;
				$follow->save();
				return 'followed';
			} else {
				$follow->delete();
				return 'unfollowed';
			}
		}
	}


	public function getVndExchangeRate() {
		$url = "http://www.vietcombank.com.vn/exchangerates/ExrateXML.aspx";
		$xml = simplexml_load_file($url);
		$exchangeRate = (int) $xml->Exrate[18]->attributes()->Buy;
		//echo "<script type='text/javascript'>alert('$exchangeRate');</script>";
		return $exchangeRate;
	}


	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create(){
		return view('/campaigns/create')->with('exchangeRate', $this->getVndExchangeRate());
	}


	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request){

			$request->validate([
				'goal' => 'required',
				'title' => 'required',

			]);
			$now = new DateTime();
			$exc = $this->getVndExchangeRate();
			$campaign = new Campaign();
			$data = Campaign::create([
				'user_id' => Auth::id(),
				'goal' => str_replace(',', '', request('goal')),
				'title' => request('title'),
				'exchange_rate' => $exc,
				'end_at' => $now->modify('+ 60 day'),
			]);
			if($campaign){
				return redirect()->route('basic', ['id' => $data->id]);
			}


	}

	public function basic($id){
		//$id = $request->query('id');

		$campaign = Campaign::find($id);

		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}

		$categories = Category::all();

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
		$campaign = Campaign::find($id);
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
		//var_dump($campaign->tags); die;

		$campaign->title = $request->title;
		$campaign->tagline = $request->tagline;
		$campaign->location =  $request->location;
		$campaign->category_id = $request->categories;
		$campaign->duration = $request->duration;
		if(!$img == ""){
			$campaign->avatar = $img;
		}
		$campaign->save();
		$tag = new Tag();

		$string = $request->tags;
		$token = strtok($string, ", ");
		while ($token !== false)
		   {
			$tag = Tag::create([
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
	$campaign = Campaign::find($id);
	if($campaign->user_id != Auth::id())
	{
		return redirect('');
	}

	try {
	  $video = Video::where('campaign_id', $id)->latest()->first()->link;

	}
	catch (\Exception $e) {
		$video = '';

	}

	try {
	  $photo = Photo::where('campaign_id', $id)->latest()->first()->link;

	}
	catch (\Exception $e) {
		$photo = 'defaultimage.png';

	}

	//var_dump($photo); die;
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
	$campaign = Campaign::find($id);
	if($campaign->user_id != Auth::id())
	{
		return redirect('');
	}
	$photo = new Photo();

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
		$photo->campaign_id = $id;
		$photo->link = $img;
		$photo->save();
	}

	$detail=$request->pitch;
	/*
	$dom = new \domdocument();
	$dom->loadHtml($detail);
	$detail = $dom->savehtml($dom->documentElement); */
	$campaign->pitch = $detail;
	$campaign->save();
		return redirect()->route('perk', ['id' => $id]);
	}

	public function videostore(Request $request, $id)
	{
	$video = new Video();
	$video->campaign_id = $id;
	$video->link = str_replace("watch?v=","embed/",$request->video );;
	$video->save();
	return back();
	}

	public function perk($id)
	{
	//$id = $request->query('id');
	$campaign = Campaign::find($id);
	if($campaign->user_id != Auth::id())
	{
		return redirect('');
	}
	$perks = Perk::with('items')->where([['campaign_id', '=', $id],['delete_flag', '=', 0]])->get();
	//$test = $items->perks()->pluck('title');



	return view('/campaigns/perk')->with('id',$campaign->id)
								  ->with('title',$campaign->title)
								  ->with('img',$campaign->avatar)
								  ->with('perks',$perks)
								  ->with('alert', 0);
	}

	public function perkcreate(Request $request, $id)
	{

	$campaign = Campaign::find($id);
	if($campaign->user_id != Auth::id())
	{
		return redirect('');
	}
	$items = Item::where('campaign_id', $id)->get();

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


		$perk = new Perk();
		$count = $request->included_item;


		$perk->campaign_id = $id;
		$perk->price = str_replace(',', '', request('price'));
		if(request('retailprice') != ''){
		$perk->retail_price =  str_replace(',', '', request('retailprice'));
		}
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
		return redirect()->route('perk', ['id' => $id]);

	}

	public function perkedit(Request $request, $id)
	{
		$perks = Perk::find($id);
		$campaign = Campaign::find($perks->campaign_id);
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}

		$items = Item::where('campaign_id', $perks->campaign_id)->get();

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
		$perk = Perk::find($id);
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
		$perk = Perk::find($id);
		$campaign = Campaign::find($perk->campaign_id);
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}
		$perk->delete_flag = 1;
		$perk->save();

		return back();
		}

		public function item($id)
		{
		//$id = $request->query('id');
		$campaign = Campaign::find($id);
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}
		$items = Item::with('perks')->where([['campaign_id', '=', $id],['delete_flag', '=', 0]])->get();

		return view('/campaigns/item')->with('id',$campaign->id)
										->with('title',$campaign->title)
										->with('img',$campaign->avatar)
										->with('items',$items);
	}

	public function itemcreate($id)
	{
		//$id = $request->query('id');
		$campaign = Campaign::find($id);
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
		$item = new Item();
		$item->campaign_id = $id;
		$item->item_name = $request->item_name;
		$item->option_name = $request->option_name;
		$item->option_value = $request->option_value;
		$item->save();
		return redirect()->route('item', ['id' => $id]);
	}

	public function itemedit(Request $request, $id)
	{
		$items = Item::find($id);
		$campaign = Campaign::find($items->campaign_id);
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
		$item = Item::find($id);

		$item->item_name = $request->item_name;
		$item->option_name = $request->option_name;
		$item->option_value = $request->option_value;
		$item->save();
		$campaign = Campaign::find($item->campaign_id);
		$items = Item::with('perks')->where('campaign_id', $item->campaign_id)->get();

		return view('/campaigns/item')->with('id',$campaign->id)
									  ->with('title',$campaign->title)
									  ->with('items',$items)
									  ->with('img',$campaign->avatar);
	}

	public function itemdelete($id)
	{
		$item = Item::find($id);
		$campaign = Campaign::find($item->campaign_id);
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}
		$item->delete_flag = 1;
		$item->save();

		return back();
	}

	public function campaignmanager()
	{
		if(!UserDetail::where([['is_admin' ,'=' ,1],['user_id','=' , Auth::id()]])->first()){
			return redirect('');
		}
		$currenttime = new DateTime();
		$prepair_campaigns = Campaign::where([['status', '=', '0'], ['delete_flag', '=', '0']])->get();
		$campaigns = Campaign::where([['status', '=', '1'], ['delete_flag', '=', '0']])->get();
		$end_campaigns = Campaign::where([['end_at', '<=', $currenttime], ['delete_flag', '=', '0']])->get();
		$report_campaigns = ReportCampaign::with('campaigns')->distinct()->get(['campaign_id']);
		$stopped_campaigns = Campaign::where([['status', '=', '2'], ['delete_flag', '=', '0']])->get();
		$cancel_campaigns = Campaign::where([['delete_flag', '=', '1']])->get();
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

	public function categorymanager()
	{
		$categories = Category::all();
		return view('/campaigns/categorymanager')->with('categories',$categories);
	}

	public function addcategory(Request $request)
	{
		$category = new Category();
		$data = Category::create([
			'name' => request('name'),
		]);
			return back();
	}

	public function editcategory($id)
	{
		$category = Category::find($id);
		return view('/campaigns/editcategory')->with('category',$category->name)
												->with('id',$category->id);
	}

	public function updatecategory(Request $request, $id)
	{
		$category = Category::find($id);
		$category->name = request('name');
		$category->save();
		return redirect('categorymanager');
	}

	public function stopcampaign($id)
	{
		if(!UserDetail::where([['is_admin' ,'=' ,1],['user_id','=' , Auth::id()]])->first()){
			return redirect('');
		}
		$campaign = Campaign::find($id);
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

	public function runcampaign($id)
	{
		if(!UserDetail::where([['is_admin' ,'=' ,1],['user_id','=' , Auth::id()]])->first()){
			return redirect('');
		}
		$campaign = Campaign::find($id);
		$campaign->status = 1;
		$campaign->save();
		return back();
	}

	public function deletecampaign($id)
	{
		if(!UserDetail::where([['is_admin' ,'=' ,1],['user_id','=' , Auth::id()]])->first()){
			return redirect('');
		}
		$campaign = Campaign::find($id);
		$campaign->delete_flag = 1;
		$campaign->save();
		return back();
	}

	public function launchcampaign(Request $request, $id)
	{
		$campaign = Campaign::find($id);
		$currenttime = new DateTime();
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}
		$financial = FinancialInformation::where('campaign_id',$id)->first();
		//0 = invisible
		//1 = visible
		$photo = Photo::where('campaign_id',$id)->first();
		$video = Video::where('campaign_id',$id)->first();
		$perk = Perk::where('campaign_id',$id)->first();
		if(!$campaign->avatar || !$campaign->duration){


			$categories = Category::all();


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
			  $video = Video::where('campaign_id', $id)->latest()->first()->link;

			}
			catch (\Exception $e) {
				$video = '';

			}

			try {
			  $photo = Photo::where('campaign_id', $id)->latest()->first()->link;

			}
			catch (\Exception $e) {
				$photo = '';

			}
			//var_dump($photo); die;
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
		$perks = Perk::with('items')->where([['campaign_id', '=', $id],['delete_flag', '=', 0]])->get();

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

		//$currenttime->add(new DateInterval('P10D'));

		$campaign->status = 1;
		$campaign->save();
		//return redirect()->route('', ['campaign' => $campaign]);
		return redirect('/campaigns/'.$id);
	}

	public function overview($id) {
		$campaign = Campaign::find($id);
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}
		$perk = Perk::where('campaign_id',$id)->first();
		if(!$perk){
		$perks = Perk::with('items')->where([['campaign_id', '=', $id],['delete_flag', '=', 0]])->get();
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


	public function financialInformation($id)
	{

		$campaign = Campaign::find($id);
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}
		$financial = FinancialInformation::where('campaign_id',$id)->first();
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

		$campaign = Campaign::find($id);
		if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}
		$financial = new FinancialInformation();
		$financial->campaign_id = $id;
		$financial->account_number = $request->account_number;
		$financial->account_name = $request->account_name;
		$financial->bank_name = $request->bank_name;
		$financial->branch = $request->branch;
		$financial->save();

		return redirect('financialInformation/'.$id)->with("success","Thông tin tài chính được thêm thành công !");
	}

	public function reportCampaign(Request $request, $id)
	{
		$userid = Auth::id();
		return view('/campaigns/reportCampaign')->with('userid',$userid);
	}

	public function reportSent(Request $request, $id)
	{
		$report = new ReportCampaign();
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
		$report = ReportCampaign::where([['campaign_id',$id],['user_id',$userid]])->latest()->first();
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
		$reports = ReportCampaign::where('campaign_id' ,$id)->get();
		return view('/campaigns/reportmanager')->with('reports',$reports);
	}

	public function reportViewByAdmin(Request $request, $id)
	{
		if(!UserDetail::where([['is_admin' ,'=' ,1],['user_id','=' , Auth::id()]])->first()){
			$report = ReportCampaign::where(['campaign_id',$id])->latest()->first();
			return redirect('');
		}
		$report = ReportCampaign::find($id);


		return view('/campaigns/reportView')->with('report',$report);
	}
	/**
	* Display the specified resource.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/


	/**
	* Show the form for editing the specified resource.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function comment(Request $request, $id)
	{
		$request->validate([
			'comment' => 'required',
		]);
		if(!Auth::id()){
			return redirect('/login')->with("failed","Bạn cần đăng nhập để thực hiện chức năng này !");
		}
			$comment = new Comment();
			$comment->user_id = Auth::id();
			$comment->campaign_id = $id;
			$comment->text = $request->comment;
			$comment->save();
			$campaign = Campaign::find($id);
			$author = $campaign->user()->get();
			$backers = $campaign->getBackerList();
			$photos = $campaign->photos()->get();
			$perks = $campaign->perks()->orderBy('price', 'ASC')->get();
			$comments = Comment::where([['campaign_id' ,'=' ,$campaign->id]])->get();
			$videos = $campaign->videos()->get();
		  //var_dump($comments); die;
		  $tabId = 4;
			$isExpired = $this->checkExpired($campaign);
		  return view('campaigns.project', compact('campaign', 'photos', 'perks', 'backers', 'author', 'comments', 'tabId', 'videos', 'isExpired'));
	}

	public function investerlist($id)
	{
		 $campaign = Campaign::find($id);

		 if($campaign->user_id != Auth::id())
		{
			return redirect('');
		}

		 $contributions = Contribution::where([['campaign_id' ,'=' ,$id]])->get();
		//var_dump($comments); die;
		//->with('id',$campaign->id)
		return view('/campaigns/investerlist', compact('contributions','campaign'));
	}
}
