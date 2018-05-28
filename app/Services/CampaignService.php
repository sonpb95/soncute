<?php 
	namespace App\Services;

use App\Repositories\CampaignRepository as Campaign;
use App\Repositories\PerkRepository as Perk;
use App\Repositories\TagRepository as Tag;
use Illuminate\Http\Request;
use App\User;
use DateTime;
use Auth;

class CampaignService
{
    /**
     * @var Campaign
     */
	private $campaign;

    /**
     * @var Perk
     */
    private $perk;

    /**
     * @var Tag
     */
	private $tag;

    /**
     * CampaignService constructor.
     * @param Campaign $campaign
     * @param Tag $tag
     * @param Perk $perk
     */
	public function __construct(Campaign $campaign , Tag $tag, Perk $perk) {
        $this->campaign = $campaign;
        $this->perk = $perk;
		$this->tag = $tag;
	}

    /**
     * @param $request
     * @return mixed
     */
	public function create($request)
	{
		$now = new DateTime();
		return $this->campaign->create([
			'user_id' => Auth::id(),
			'goal' => str_replace(',', '', request('goal')),
			'title' => request('title'),
			'end_at' => $now->modify('+ 60 day'),
		]);
	}

    /**
     * @param $request
     * @param $campaign_id
     * @return mixed
     */
    public function makeBasic($request, $campaign_id)
    {
		$campaign = $this->campaign->find($campaign_id);
		$campaign->priority = $campaign_id;
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
	}

    /**
     * @param $id
     * @return mixed
     */
    public function getPerk($id)
    {
        return $this->perk->findWhere([['campaign_id', '=', $id],['delete_flag', '=', 0]])->first();

    }

}
