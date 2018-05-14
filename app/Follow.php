<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Campaign;

class Follow extends Model
{
  protected $fillable = ['user_id', 'campaign_id'];

  public function user() {
    return $this->belongsTo(User::class);
  }

  public function campaigns() {
    return $this->belongsToMany(Campaign::class);
  }
}
