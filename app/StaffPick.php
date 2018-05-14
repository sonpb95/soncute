<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffPick extends Model
{   public $timestamps = false;
    public function categories() {
      return $this->hasMany(Category::class);
    }

    public function campaigns() {
      return $this->hasMany(Campaign::class);
    }

    /*public static function getCampaignsByCategory($categoryId, $quantity) {
      $campaignIds = StaffPick::where('category_id', $categoryId)->take($quantity)->pluck('campaign_id');
      $campaignArray = Array();
      foreach ($campaignIds as $campaignId) {
        $campaign = Campaign::where('id', $campaignId)->get();
        array_push($campaignArray, $campaign);
      }
      return $campaignArray;

      //$campaigns = StaffPick::campaigns()->where('category_id', $categoryId)->take($quantity);
    }*/
}
