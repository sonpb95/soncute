<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [

        'link', 'delete_flag'

    ];
	
	//public $timestamps = false;
	
    public function campaign() {
      return $this->belongsTo(Campaign::class);
    }
}
