<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [

        'id', 'campaign_id', 'item_name', 'option_name', 'option_value', 'delete_flag'

    ];
	
	public function perks() {
      return $this->belongsToMany(Perk::class,'perk_item','item_id','perk_id');
    }
	
	public $timestamps = false;
	
    
}
