<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [

        'link', 'delete_flag'

    ];
	
	public function campaign() {
		
      return $this->belongsTo(Campaign::class);
	  
    }
}
