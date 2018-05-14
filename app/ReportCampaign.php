<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportCampaign extends Model
{
    protected $fillable = [

        'reason'

    ];
	
	public function user() {
		return $this->belongsTo(User::class);
	}
	
	public function campaigns() {
		return $this->belongsTo(Campaign::class, 'campaign_id');
	}
}
