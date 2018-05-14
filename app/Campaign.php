<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use DateTime;
use Auth;

class Campaign extends Model
{
  use Searchable;
  protected $fillable = [
    'user_id', 'goal', 'title', 'tagline', 'pitch', 'avatar', 'city','duration' , 'country', 'category_id', 'visible', 'status', 'exchange_rate', 'end_at',
  ];

	protected $dates = ['end_at', 'start_at'];

  public function searchableAs() {
    return 'campaigns_index';
  }

	public function tags()
  {
    return $this->belongsToMany('App\Tag', 'campaign_tag', 'campaign_id', 'tag_id');
  }

	public function category() {
		return $this->belongsTo(Category::class, 'category_id');
	}

	public function report_campaigns() {
		return $this->hasMany(ReportCampaign::class);
	}

	public function user() {
    return $this->belongsTo(User::class);
	}

	public function photos() {
    return $this->hasMany(Photo::class);
	}

	public function comments() {
    return $this->hasMany(Comment::class);
	}

   public function follows() {
     return $this->belongsToMany(Follow::class);
  }

	public function videos() {
		return $this->hasMany(Video::class);
	}

	public function perks() {
		return $this->hasMany(Perk::class);
	}

	public function contributions() {
		return $this->hasMany(Contribution::class);
	}

	public function staffPick() {
		return $this->belongsTo(StaffPick::class);
	}

  public function isFollowed() {
    if (Auth::check()) {
        $follow = Auth::user()->follows()->where('campaign_id', $this->id)->first();
        if(is_null($follow)) {
          return 'false'; // return a string to use in jquery
        } else {
          return 'true';
        }
    } else {
      return 'false';
    }
  }

	public function getBackerList() {
    $backerList = Array();
    $contributions = $this->contributions()->orderBy('date','asc')->distinct(['user_id', 'guest_detail_id'])->get();

    foreach ($contributions as $contribution) {

      $backer = $contribution->user()->first();
      $guestBacker = $contribution->guestDetail()->first();

      if ($backer != '' && !in_array($backer, $backerList)) {
        array_push($backerList, $backer);
      } else if ($guestBacker != '' && !in_array($guestBacker, $backerList)){
        array_push($backerList, $guestBacker);
      }
    }

		return $backerList;
	}

	public function getBackerCount() {
		return count($this->getBackerList());
	}

	public function getBoughtPerks() {
		return $this->perks()->has('contributions')->get();
	}

  public function getFundRaised() {
		$perks = $this->getBoughtPerks();
		$fundRaised = 0;
		foreach ($perks as $perk) {
		  $price = $perk->price;
		  $amount = $perk->contributions()->count();
		  $fundRaised += $price * $amount;
		}
		return $fundRaised;
	}

	public function getFomattedFundRaised() {
		$fundRaised = $this->getFundRaised();

    if ($fundRaised < 100000) {
      $fundRaised = number_format($fundRaised, 0, ',', ".") . "đ";
    }

    if ($fundRaised >= 100000 &&  $fundRaised < 1000000) {
      $fundRaised = round($fundRaised / 1000, 0) . "K";
    }

    if ($fundRaised >= 1000000 && $fundRaised < 1000000000) {
      $fundRaised = round($fundRaised / 1000000, 2) . "M";
    }

    if ($fundRaised >= 1000000000) {
      $fundRaised = round($fundRaised / 1000000000, 1) . "tỷ ";
    }
		return $fundRaised;
	}

	public function getPercents() {
		$fundRaised = $this->getFundRaised();
		return round($fundRaised / $this->goal * 100);
	}

	public function getDayLeft() {
		$endTime = new DateTime($this->end_at);
		$now = new DateTime();
		$diffTime = $endTime->diff($now)->days;
    if ($diffTime > 0 && $endTime > $now) {
      return $diffTime;
    } else {
      return 0;
    }
	}

	public function getAuthorId() {
		$author = $this->user()->get();
		return $author->get('0')->id;
	}

	public function getAuthorName() {
		$author = $this->user()->get();
		return $author->get('0')->name;
	}

	public function getCategoryName() {
		$category = $this->category()->get();
		return $category->get('0')->name;
	}

  public function getCommentsCount() {
    return $this->comments()->count();
  }

}
