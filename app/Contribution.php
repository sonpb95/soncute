<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    public $timestamps = false;
    protected $dates = ['date'];
    protected $fillable = [
        'user_id', 'date', 'campaign_id', 'perk_id',
    ];

    public function user() {
      return $this->belongsTo(User::class);
    }

    public function campaign() {
      return $this->belongsTo(Campaign::class);
    }

    public function Perk() {
      return $this->belongsTo(Perk::class);
    }

    public function guestDetail() {
      return $this->belongsTo(GuestDetail::class);
    }

}
