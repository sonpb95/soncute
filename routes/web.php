<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//login
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );

//index
Route::get('/', 'PageController@index')->name('index');

//campaigns show
Route::get('/campaigns/{id}', 'Campaign\CampaignsController@show');

// campaigns create
Route::get('/create', ['middleware' => 'auth', 'uses' => 'Campaign\CampaignsController@create'])->name('create');
Route::post('/campaigns', 'Campaign\CampaignsController@store')->name('store');
Route::post('/launchcampaign/{id}', 'Campaign\CampaignsController@launchCampaign')->name('launchcampaign');

//campaign basic
Route::get('/basic/{id}', ['middleware' => 'auth', 'uses' => 'Campaign\CampaignsController@basic'])->name('basic');
Route::post('/basicstore/{id}', 'Campaign\CampaignsController@basicStore')->name('basicstore');

//campaign story
Route::get('/story/{id}', ['middleware' => 'auth', 'uses' => 'Campaign\CampaignsController@story'])->name('story');
Route::post('/videostore/{id}', 'Campaign\CampaignsController@videoStore')->name('videostore');
Route::post('/storystore/{id}', 'Campaign\CampaignsController@storyStore')->name('storystore');

//perk
Route::get('/perk/{id}', ['middleware' => 'auth', 'uses' => 'Campaign\PerkController@perk'])->name('perk');
Route::get('/perkcreate/{id}', ['middleware' => 'auth', 'uses' => 'Campaign\PerkController@perkCreate'])->name('perkcreate');
Route::post('/perkstore/{id}', 'Campaign\PerkController@perkStore')->name('perkstore');
Route::get('/perkedit/{id}', ['middleware' => 'auth', 'uses' => 'Campaign\PerkController@perkEdit'])->name('perkedit');
Route::post('/perkupdate/{id}', 'Campaign\PerkController@perkUpdate')->name('perkupdate');
Route::get('/perkdelete/{id}', 'Campaign\PerkController@perkDelete')->name('perkdelete');

//items
Route::get('/item/{id}', ['middleware' => 'auth', 'uses' => 'Campaign\ItemController@item'])->name('item');
Route::get('/itemdelete/{id}', 'Campaign\ItemController@itemDelete')->name('itemdelete');
Route::get('/itemcreate/{id}', ['middleware' => 'auth', 'uses' => 'Campaign\ItemController@itemCreate'])->name('itemcreate');
Route::post('/itemstore/{id}', 'Campaign\ItemController@itemStore')->name('itemstore');
Route::get('/itemedit/{id}', ['middleware' => 'auth', 'uses' => 'Campaign\ItemController@itemEdit'])->name('itemedit');
Route::post('/itemupdate/{id}', 'Campaign\ItemController@itemUpdate')->name('itemupdate');

//campaign management
Route::get('/campaignmanager', ['middleware' => 'auth', 'uses' => 'AdminController@campaignManager'])->name('campaignmanager');
Route::get('/stopcampaign/{id}', 'AdminController@stopCampaign')->name('stopcampaign');
Route::get('/runcampaign/{id}', 'AdminController@runCampaign');
Route::get('/deletecampaign/{id}', 'AdminController@deleteCampaign')->name('deletecampaign');

// invester list
Route::get('/investerlist/{id}', 'Campaign\CampaignsController@investerList')->name('investerlist');

//manage categories
Route::post('/addcategory', ['middleware' => 'auth', 'uses' => 'Campaign\CategoriesController@addcategory'])->name('addcategory');
Route::get('/editcategory/{category}', ['middleware' => 'auth', 'uses' => 'Campaign\CategoriesController@editcategory'])->name('editcategory');
Route::post('/updatecategory/{id}', 'Campaign\CategoriesController@updatecategory')->name('updatecategory');

//finalcial & reports
Route::get('/financialInformation/{id}', 'Campaign\FinancialInformationController@financialInformation')->name('financialInformation');
Route::post('/financialInformationstore/{id}', 'Campaign\FinancialInformationController@financialInformationstore');
Route::get('/reportCampaign/{id}', 'Campaign\ReportController@reportCampaign')->name('reportCampaign');
Route::post('/reportSent/{id}', 'Campaign\ReportController@reportSent');
Route::get('/reportmanager/{id}', 'Campaign\ReportController@reportManager')->name('reportmanager');
Route::get('/reportViewByAdmin/{id}', 'Campaign\ReportController@reportViewByAdmin')->name('reportViewByAdmin');
Route::get('/overview/{id}', 'Campaign\CampaignsController@overView');


//admin
Route::get('/admin', ['middleware' => 'auth', 'uses' => 'AdminController@show'])->name('admin');
Route::get('/categorymanager', ['middleware' => 'auth', 'uses' => 'Campaign\CategoriesController@categorymanager'])->name('categorymanager');
Route::get('/users/usermanager', 'UsersController@usermanager')->name('usermanager');
Route::get('/users/useraccessmanager/{id}', ['middleware' => 'auth', 'uses' => 'UsersController@useraccessmanager'])->name('useraccessmanager');
Route::get('/users/isadmin/{id}', 'UsersController@isadmin')->name('isadmin');
Route::get('/users/removeadmin/{id}', 'UsersController@removeadmin')->name('removeadmin');
Route::get('/users/deleteuser/{id}', 'UsersController@deleteuser')->name('deleteuser');


//users
Route::get('/users/{user}', 'UsersController@show');
Route::get('/users/{user}/{tabId}', 'UsersController@show');
Route::post('/users/{user}/update', 'UsersController@update')->name('profile.update'); //change user info
Route::post('/users/{user}/details/update', 'UsersController@updateDetail');
Route::post('/users/{user}/password/update', 'UsersController@changePassword');

//categories
Route::get('/loadMoreCampaign/{lastPriority}/{category}', 'Campaign\CategoriesController@loadMoreCampaign');
Route::get('/categories/{id}', 'Campaign\CategoriesController@show');
Route::get('/discover', 'Campaign\CategoriesController@discover');
Route::get('/now-launched', 'Campaign\CategoriesController@nowLauched');
Route::get('/ending-soon', 'Campaign\CategoriesController@endingSoon');
Route::get('/small-project', 'Campaign\CategoriesController@smallGoal');

//payments
Route::get('/payment/process', 'Campaign\PaymentsController@process')->name('payment.process');
Route::get('/payment/process/{perk}', 'Campaign\PaymentsController@process');
Route::get('/payment/sucess/{perk}', 'Campaign\PaymentsController@paymentSucess')->name('payment.sucess');
Route::get('/payment/{perk}', 'Campaign\PaymentsController@show');
Route::post('/update-user-detail', 'Campaign\PaymentsController@updateUserDetail');

//info
Route::get('/cac-dieu-khoan-chung', 'PageController@viewDieuKhoanChung');
Route::get('/chi-phi-goi-von', 'PageController@viewChiPhi');
Route::get('/quy-dinh-hoan-tra', 'PageController@viewHoanTra');
Route::get('/chinh-sach-bao-mat', 'PageController@viewChinhSachBaoMat');
Route::get('/huong-dan-su-dung', 'PageController@viewHuongDanSuDung');


//search
Route::get('/search', 'SearchController@search');

//blogs
Route::get('/blog', 'PageController@viewBlog');
Route::get('/posts', 'PageController@viewBlogPost');

//Social network
Route::get('/redirect/{social}', 'SocialAuthController@redirect');
Route::get('/callback/{social}', 'SocialAuthController@callback');

//action
Route::get('/follow/{id}', 'FollowController@follow');
Route::post('/comment/{id}', 'Campaign\CommentController@comment');

?>
