<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
		'user_id',
		'campaign_id',
        'text'

    ];
	
	//public $timestamps = false;
	public function campaign() {
      return $this->belongsTo(Campaign::class, 'campaign_id');
    }
	
	public function user() {
    return $this->belongsTo(User::class);
	}
   
}
