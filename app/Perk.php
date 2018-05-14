<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perk extends Model
{
    protected $fillable = [

        'price', 'retail_price', 'title', 'included_items', 'description', 'photo_id', 'total_quantily', 'estimated_delivery_date', 'ship', 'buy_number'

    ];
	
	public function campaign() {
		return $this->belongsTo(Campaign::class);
	  }

	  public function contributions() {
		return $this->hasMany(Contribution::class);
	  }

	  public function items() {
		return $this->belongsToMany(Item::class,'perk_item','perk_id','item_id');
	  }

	
}
