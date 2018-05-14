<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [

        'id', 'title'

    ];
	
	public function campaigns() {
		
    return $this->belongsToMany(Campaign::class,'campaign_tag','tag_id','campaign_id');
	
    }
}
