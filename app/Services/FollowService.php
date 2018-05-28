<?php 
	namespace App\Services;

use App\Repositories\CampaignRepository as Campaign;
use App\Repositories\FollowRepository as Follow;
use Illuminate\Http\Request;
use App\User;
use DateTime;
use Auth;

class FollowService
{
    /**
     * @var Campaign
     */
	private $campaign;

    /**
     * @var Follow
     */
	private $follow;

    /**
     * FollowService constructor.
     * @param Campaign $campaign
     * @param Follow $follow
     */
	public function __construct(Campaign $campaign, Follow $follow) {
		$this->campaign = $campaign;
		$this->follow = $follow;

	}

    /**
     * @param $id
     * @return string
     */
	public function follow($id)
	{
		$campaign = $this->campaign->find($id);
		if (Auth::check()) {
			$follow = Auth::user()->follows()->where('campaign_id', $campaign->id)->first();
			if(is_null($follow)) {
				$follow = $this->follow->create([
					'user_id' => Auth::id(),
					'campaign_id' => $campaign->id,
				]);
				return 'followed';
			} else {
				$follow->delete();
				return 'unfollowed';
			}
		}
	}
}