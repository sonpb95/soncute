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
Route::get('/campaigns/{campaign}', 'CampaignsController@show');
Route::get('/campaigns/{campaign}/{tabId}', 'CampaignsController@show');

// campaigns create
Route::get('/create', ['middleware' => 'auth', 'uses' => 'CampaignsController@create'])->name('create');
Route::post('/campaigns', 'CampaignsController@store')->name('store');
Route::post('/launchcampaign/{id}', 'CampaignsController@launchcampaign')->name('launchcampaign');

//campaign basic
Route::get('/basic/{id}', ['middleware' => 'auth', 'uses' => 'CampaignsController@basic'])->name('basic');
Route::post('/basicstore/{id}', 'CampaignsController@basicstore')->name('basicstore');

//campaign story
Route::get('/story/{id}', ['middleware' => 'auth', 'uses' => 'CampaignsController@story'])->name('story');
Route::post('/videostore/{id}', 'CampaignsController@videostore')->name('videostore');
Route::post('/storystore/{id}', 'CampaignsController@storystore')->name('storystore');

//perk
Route::get('/perk/{id}', ['middleware' => 'auth', 'uses' => 'CampaignsController@perk'])->name('perk');
Route::get('/perkcreate/{id}', ['middleware' => 'auth', 'uses' => 'CampaignsController@perkcreate'])->name('perkcreate');
Route::post('/perkstore/{id}', 'CampaignsController@perkstore')->name('perkstore');
Route::get('/perkedit/{id}', ['middleware' => 'auth', 'uses' => 'CampaignsController@perkedit'])->name('perkedit');
Route::post('/perkupdate/{id}', 'CampaignsController@perkupdate')->name('perkupdate');
Route::get('/perkdelete/{id}', 'CampaignsController@perkdelete')->name('perkdelete');

//items
Route::get('/item/{id}', ['middleware' => 'auth', 'uses' => 'CampaignsController@item'])->name('item');
Route::get('/itemdelete/{id}', 'CampaignsController@itemdelete')->name('itemdelete');
Route::get('/itemcreate/{id}', ['middleware' => 'auth', 'uses' => 'CampaignsController@itemcreate'])->name('itemcreate');
Route::post('/itemstore/{id}', 'CampaignsController@itemstore')->name('itemstore');
Route::get('/itemedit/{id}', ['middleware' => 'auth', 'uses' => 'CampaignsController@itemedit'])->name('itemedit');
Route::post('/itemupdate/{id}', 'CampaignsController@itemupdate')->name('itemupdate');

//campaign management
Route::get('/campaignmanager', ['middleware' => 'auth', 'uses' => 'CampaignsController@campaignmanager'])->name('campaignmanager');
Route::get('/stopcampaign/{id}', 'CampaignsController@stopcampaign')->name('stopcampaign');
Route::get('/runcampaign/{id}', 'CampaignsController@runcampaign');
Route::get('/deletecampaign/{id}', 'CampaignsController@deletecampaign')->name('deletecampaign');

// invester list
Route::get('/investerlist/{id}', 'CampaignsController@investerlist')->name('investerlist');

//manage categories
Route::post('/addcategory', ['middleware' => 'auth', 'uses' => 'CampaignsController@addcategory'])->name('addcategory');
Route::get('/editcategory/{category}', ['middleware' => 'auth', 'uses' => 'CampaignsController@editcategory'])->name('editcategory');
Route::post('/updatecategory/{id}', 'CampaignsController@updatecategory')->name('updatecategory');

//finalcial & reports
Route::get('/financialInformation/{id}', 'CampaignsController@financialInformation')->name('financialInformation');
Route::post('/financialInformationstore/{id}', 'CampaignsController@financialInformationstore');
Route::get('/reportCampaign/{id}', 'CampaignsController@reportCampaign')->name('reportCampaign');
Route::post('/reportSent/{id}', 'CampaignsController@reportSent');
Route::get('/reportmanager/{id}', 'CampaignsController@reportmanager')->name('reportmanager');
Route::get('/reportViewByAdmin/{id}', 'CampaignsController@reportViewByAdmin')->name('reportViewByAdmin');
Route::get('/overview/{id}', 'CampaignsController@overview');


//admin
Route::get('/admin', ['middleware' => 'auth', 'uses' => 'AdminController@show'])->name('admin');
Route::get('/categorymanager', ['middleware' => 'auth', 'uses' => 'CampaignsController@categorymanager'])->name('categorymanager');
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
Route::get('/loadMoreCampaign/{lastPriority}/{category}', 'CategoriesController@loadMoreCampaign');
Route::get('/categories/{category}', 'CategoriesController@show');
Route::get('/discover', 'CategoriesController@discover');
Route::get('/now-launched', 'CategoriesController@nowLauched');
Route::get('/ending-soon', 'CategoriesController@endingSoon');
Route::get('/small-project', 'CategoriesController@smallGoal');

//payments
Route::get('/payment/process', 'PaymentsController@process')->name('payment.process');
Route::get('/payment/process/{perk}', 'PaymentsController@process');
Route::get('/payment/sucess/{perk}', 'PaymentsController@paymentSucess')->name('payment.sucess');
Route::get('/payment/{perk}', 'PaymentsController@show');
Route::post('/update-user-detail', 'PaymentsController@updateUserDetail');

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
Route::get('/follow/{campaign}', 'CampaignsController@follow');
Route::post('/comment/{id}', 'CampaignsController@comment');

?>
