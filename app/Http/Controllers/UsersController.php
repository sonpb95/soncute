<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Image;
use Hash;
use Auth;
use App\Campaign;
use App\UserDetail;
use App\Tag;
use App\Item;
use App\Perk;
use App\Video;
use App\Photo;
use App\Categories;
use App\Contribution;
use App\Follow;
use File;
use Storage;
use DB;

class UsersController extends Controller
{
    public function show(User $user, $tabId = 1) {
      $userDetail = $user->getDetails();
      $campaigns = $user->campaigns()->get();
      $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
	    $mycontributions = Contribution::where('user_id', $user->id)->get();
      $follows = $user->follows()->get();
      $followCampaigns = Array();
      foreach ($follows as $follow) {
        $campaignId = $follow->campaign_id;
        $campaign = Campaign::find($campaignId);
        array_push($followCampaigns, $campaign);
      }
      if(Auth::check()) {
        $isSocialAccount = DB::table('social_accounts') ->where('user_id', '=', Auth::id()) ->exists();
      } else {
        $isSocialAccount = false;
      }
      return view('users.profile', compact('user', 'userDetail', 'campaigns', 'countries', 'mycontributions', 'tabId', 'followCampaigns', 'isSocialAccount'));
    }

    public function update(Request $request, User $user) {
     $this->validate(request(), [
        'name' => 'required|min:3|max:255',
        'biography' => 'required|max:500'
      ]);

      //get user data
      $userData = $request->all();

      $user->name = $userData['name'];
      $user->biography = $userData['biography'];

      $user->save();

      return redirect('/users/'.$user->id.'/1');
    }

    public function updateDetail(Request $request, User $user) {
     $userDetail = $user->userDetail()->first();
     if (is_null($userDetail)) {
       $userDetail = new UserDetail();
       $userDetail->user_id = $user->id;
     }
     $this->validate(request(), [
        'full_name' => 'required|min:3|max:255',
        'phone_number' => 'required|min:6|numeric|max:100000000000000000000000000000000000000000000000000000000000000000',
        'postal_code' => 'required|min:2|numeric|max:100000000000000000000000000000000000000000000000000000000000000000',
        'country' => 'required|max:255',
        'city' => 'required|max:255',
        'address' => 'required|min:2|max:255'
      ]);

    	// Handle the user upload of avatar
    	if($request->hasFile('avatar')){
    		$avatar = $request->file('avatar');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();
        $filePath = public_path('/uploads/avatars/' . $filename);
    		Image::make($avatar)->resize(380, 380)->save( $filePath );
    		$userDetail->avatar = $filename;
    	}

      //get user data
      $userData = $request->all();

      $userDetail->full_name = $userData['full_name'];
      $userDetail->phone_number = $userData['phone_number'];
      $userDetail->country = $userData['country'];
      $userDetail->city = $userData['city'];
      $userDetail->postal_code = $userData['postal_code'];
      $userDetail->address = $userData['address'];

      $userDetail->save();

      return redirect('/users/'.$user->id.'/3');
    }

    public function changePassword(Request $request, User $user) {
      if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
           // The passwords matches
           return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
       }

       if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
           //Current password and new password are same
           return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
       }

       $validatedData = $request->validate([
           'current-password' => 'required',
           'new-password' => 'required|string|min:6|confirmed',
       ]);

       //Change Password
       $user = Auth::user();
       $user->password = bcrypt($request->get('new-password'));
       $user->save();

       return redirect()->back()->with("success","Password changed successfully !");
    }

	public function usermanager()
    {
		if(!UserDetail::where([['is_admin' ,'=' ,1],['user_id','=' , Auth::id()]])->first()){
			return redirect('');
		}

		$users = User::where('delete_flag', 0)->get();
		$admins = UserDetail::with('user')->where('is_admin',1)->get();

        return view('/users/usermanager')->with('users',$users)
										->with('admins',$admins);
    }

	public function useraccessmanager($id)
    {
		if(!UserDetail::where([['is_admin' ,'=' ,1],['user_id','=' , Auth::id()]])->first()){
			return redirect('');
		}
		$users = User::find($id);
		$admin = UserDetail::where([['is_admin' ,'=' ,1],['user_id','=' , $id]])->first();


        return view('/users/useraccessmanager')->with('users',$users)
												->with('admin',$admin);
    }

	public function isadmin($id)
    {
		if(!UserDetail::where([['is_admin' ,'=' ,1],['user_id','=' , Auth::id()]])->first()){
			return redirect('');
		}

		try {
			$user = UserDetail::where('user_id', $id)->get();
			$user->is_admin = 1;
			$user->save();

		} catch (\Exception $e) {
			$user = new UserDetail();
			$user->user_id = $id;
			$user->is_admin = 1;
			$user->save();

		}


        return redirect()->route('usermanager');
    }

	public function removeadmin($id)
    {
		if(!UserDetail::where([['is_admin' ,'=' ,1],['user_id','=' , Auth::id()]])->first()){
			return redirect('');
		}

			$user = UserDetail::where('user_id', $id)->first();
			$user->is_admin = 0;
			$user->save();




        return redirect()->route('usermanager');
    }

	public function deleteuser($id)
    {
		if(!UserDetail::where([['is_admin' ,'=' ,1],['user_id','=' , Auth::id()]])->first()){
			return redirect('');
		}

		$user = User::find($id);
		$user->delete_flag = 1;
		$user->save();


		return redirect()->route('usermanager');
    }
}
