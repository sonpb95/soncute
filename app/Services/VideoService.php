<?php 
	namespace App\Services;

use App\Repositories\VideoRepository as Video;
use Illuminate\Http\Request;
use App\User;
use DateTime;
use Auth;

class VideoService
{
    /**
     * @var Video
     */
	private $video;

    /**
     * VideoService constructor.
     * @param Video $video
     */
	public function __construct(Video $video) {
		$this->video = $video;
	}

    /**
     * @param $request
     * @param $campaign_id
     */
	public function make($request, $campaign_id){
		$video = $this->video->create([
			'campaign_id' => $campaign_id,
			'link' => str_replace("watch?v=","embed/",$request->video)
		]);
	}

    /**
     * @param $campaign_id
     * @return string
     */
	public function getVideo($campaign_id){
		try {
			$video = $this->video->findWhere([['campaign_id' ,'=' ,$id]])->first()->link;
		}
		catch (\Exception $e) {
			$video = '';
		}
		return $video;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function checkVideo($id)
    {
        return $this->video->findWhere([['campaign_id' ,'=' ,$id]])->first();
    }

}
