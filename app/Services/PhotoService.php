<?php 
	namespace App\Services;
use App\Repositories\PhotoRepository as Photo;
use Illuminate\Http\Request;
use File;

class PhotoService
{
    /**
     * @var Photo
     */
	private $photo;

    /**
     * PhotoService constructor.
     * @param Photo $photo
     */
    public function __construct(Photo $photo) 
    {
		$this->photo = $photo;
	}

    /**
     * @param Request $request
     * @param $campaignId
     * @param string $img
     */
    public function make(Request $request, $campaignId, $img = "")
    {
		if($request->hasFile('img')){
			$destinationPath="img";
			$file = $request->img;
			$extension=$file->getClientOriginalExtension();
			$fileName = rand(1010,9999).".".$extension;
			$file->move($destinationPath,$fileName);
			$img = $fileName;
		}
		if(!$img == ""){
			$this->photo->create([
				'campaign_id' => $campaignId,
				'link' => $img,
			]);
		}
    }

    /**
     * @param $campaignId
     * @return string
     */
    public function getPhoto($campaignId)
    {
		try {
			$photo = $this->photo->findWhere([['campaign_id' ,'=' ,$campaignId]])->first()->link;
		}
		catch (\Exception $e) {
			$photo = 'defaultimage.png';
		}
		return $photo;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function checkPhoto($id)
    {
        return $this->photo->findWhere([['campaign_id' ,'=' ,$id]])->first();
    }

}
