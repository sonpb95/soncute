<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestDetail extends Model
{
  protected $fillable = ['full_name', 'phone_number', 'country', 'city', 'postal_code', 'address', 'guest_detail_id'];
  public function contributions() {
    return $this->hasMany(Contribution::class);
  }
}
