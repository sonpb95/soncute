<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perk;
use App\Contribution;
use App\Campaign;
use App\UserDetail;
use App\GuestDetail;
use App\Comment;
use Auth;
use DateTime;
use Braintree_Transaction;
use Session;

class PaymentsController extends Controller
{
  public function show(Perk $perk) {
    $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");

    $userDetail = new UserDetail();

    if(Auth::check()) {
      $user = Auth::user();
      $userDetail = $user->userDetail()->first();
    }

    $exchangeRate = $this->getCampaignExchangeRate($perk);
    return view('payment.process', compact('perk','countries','userDetail','exchangeRate'));
  }

  public function getVndExchangeRate() {
    $url = "http://www.vietcombank.com.vn/exchangerates/ExrateXML.aspx";
    $xml = simplexml_load_file($url);
    $exchangeRate = (int) $xml->Exrate[18]->attributes()->Buy;
    //echo "<script type='text/javascript'>alert('$exchangeRate');</script>";
    return $exchangeRate;
  }

  public function getCampaignExchangeRate(Perk $perk) {
    $exchangeRate = 22750; // default exchange Rate
    $campaignExRate = $perk->campaign()->first()->exchange_rate;

    if (!is_null($campaignExRate)) {
      $exchangeRate = $campaignExRate;
    } else {
      $exchangeRate = $this->getVndExchangeRate();
    }
    return $exchangeRate;
  }

  public function process(Request $request, Perk $perk)
  {
    $payload = $request->input('payload', false);
    $nonce = $payload['nonce'];
    $price = $perk->price;
    $exchangeRate = $this->getCampaignExchangeRate($perk);
    $status = Braintree_Transaction::sale([
      //'amount' =>  '10.00',
      'amount' => round($price / $exchangeRate, 2), //lam tron den 2 chu so thap phan
      'paymentMethodNonce' => $nonce,
      'options' => [
        'submitForSettlement' => True
      ]
    ]);
    return response()->json($status);
  }

  public function updateUserDetail(Request $request){
    $this->validate(request(), [
       'full_name' => 'required|min:3',
       'phone_number' => 'required|min:6|numeric',
       'country' => 'required',
       'city' => 'required',
       'address' => 'required|min:2'
     ]);

     //get user data
     $userData = $request->all();
     $perkId = $request['perkId'];

    if (Auth::check()) {
      $user = Auth::user();
      $userDetail = $user->userDetail()->first();
      if (is_null($userDetail)) {
        $userDetail = new UserDetail();
        $userDetail->user_id = $user->id;
      }

       $userDetail->full_name = $userData['full_name'];
       $userDetail->phone_number = $userData['phone_number'];
       $userDetail->country = $userData['country'];
       $userDetail->city = $userData['city'];
       $userDetail->postal_code = $userData['postal_code'];
       $userDetail->address = $userData['address'];

       $userDetail->save();
    } else {
      $guestDetail = new GuestDetail();
      $guestDetail->full_name = $userData['full_name'];
      $guestDetail->phone_number = $userData['phone_number'];
      $guestDetail->country = $userData['country'];
      $guestDetail->city = $userData['city'];
      $guestDetail->postal_code = $userData['postal_code'];
      $guestDetail->address = $userData['address'];

      $guestDetail->save();

      Session::put([
        'guest_id' => $guestDetail->id,
        'full_name' => $guestDetail->full_name,
        'phone_number' => $guestDetail->phone_number,
        'country' => $guestDetail->country,
        'city' => $guestDetail->city,
        'postal_code' => $guestDetail->postal_code,
        'address' => $guestDetail->address
      ]);
    }
    return redirect('/payment/' . $perkId);
  }

  public function updateCampaignDetail(Campaign $campaign) {
    if ($campaign->getPercents() >= 100) {
      $campaign->priority = null;
      $campaign->save();
    }
  }

  public function paymentSucess(Request $request, Perk $perk) {
    $campaign = $perk->campaign()->first();

    $contribution = new Contribution();
    $contribution->perk_id = $perk->id;
    $contribution->campaign_id = $campaign->id;
    $contribution->date = (new DateTime())->format('Y-m-d H:i:s');
    if (Auth::check()) {
        $contribution->user_id = Auth::id();
    } else {
        $contribution->user_id = null;
        $contribution->guest_detail_id = Session::get('guest_id');
    }

    $contribution->save();

    $this->updateCampaignDetail($campaign);

    return redirect('/campaigns/'.$campaign->id);

    /*$author = $campaign->user()->get();
    $backers = $campaign->getBackerList();
    $photos = $campaign->photos()->get();
    $perks = $campaign->perks()->orderBy('price', 'ASC')->get();
    $comments = $campaign->comments()->orderBy('created_at', 'DESC')->get();
    $tabId = 1;
    return view('campaigns.project', compact('campaign', 'photos', 'perks', 'backers', 'author', 'comments','tabId'));*/
  }
}
