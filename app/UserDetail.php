<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserDetail extends Model
{
    protected $fillable = ['avatar', 'full_name', 'phone_number', 'country', 'city', 'postal_code', 'address'];
    public function user() {
      return $this->belongsTo(User::class);
    }
}
