<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [

        'id', 'name'

    ];

	 public $timestamps = false;

	 public function campaigns() {
    return $this->hasMany(Campaign::class);
	  }

	  public function staffPick() {
		return $this->belongsTo(StaffPick::class);
	  }

	  public function getCampaignCount() {
		return $this->campaigns()->orderBy('priority', 'ASC')->where('delete_flag', '0')->where('status', '!=', '0')->count();
	  }

}
