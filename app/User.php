<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    public $timestamps = false;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'biography',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userDetail() {
      return $this->hasOne(UserDetail::class);
    }

    public function creditCard() {
      return $this->hasMany(CreditCard::class);
    }

    public function campaigns() {
      return $this->hasMany(Campaign::class);
    }

    public function contributions() {
      return $this->hasMany(Contribution::class);
    }

    public function follows() {
      return $this->hasMany(Follow::class);
    }

	  public function comments() {
       return $this->hasMany(Comment::class);
	  }

    public function getDetails() {
      $userDetail = $this->userDetail()->get();
      $detailId = $userDetail->get('0')->id;
      $avatar = $userDetail->get('0')->avatar;
      $fullName = $userDetail->get('0')->full_name;
      $city = $userDetail->get('0')->city;
      $country = $userDetail->get('0')->country;
      $campaignCount = $this->campaigns()->count();
      $phoneNumber = $userDetail->get('0')->phone_number;
      $postalCode = $userDetail->get('0')->postal_code;
      $address = $userDetail->get('0')->address;

      return ['id' => $detailId,
              'avatar' => $avatar,
              'fullName' => $fullName,
              'city' => $city,
              'country' => $country,
              'campaignCount' => $campaignCount,
              'phoneNumber' => $phoneNumber,
              'postalCode' => $postalCode,
              'address' => $address];
    }

    public function getAvatar() {
      $userDetail = $this->userDetail()->get();
      return $userDetail->get('0')->avatar;
    }

    public function getCity() {
      $userDetail = $this->userDetail()->get();
      return $userDetail->get('0')->city;
    }

    public function getCampaignCount() {
      return $this->campaigns()->count();
    }

}
