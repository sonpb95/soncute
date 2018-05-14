<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\UserDetail;
use App\Campaign;
use App\User;
use \Datetime;
use Carbon\Carbon;
use DB;

class PageController extends Controller
{
    public function index() {
      $categories = Category::all()->where('id', '<=', '7')->sortBy('name');

      $staffPickCampaign = Campaign::orderBy(DB::raw('-`priority`'), 'desc')->orderBy('created_at', 'desc')->where('delete_flag', '0')->where('status', '!=', '0')->where('status', '!=', '3')->first();
      $staffPickCategory = $staffPickCampaign->category()->get();

      $randomUsers = User::inRandomOrder()->take(18)->get();

      $randomCampaigns = Campaign::inRandomOrder()->where('delete_flag', '!=', '1')->where('status', '!=', '0')->where('status', '!=', '3')->take(4)->get();

      return view('layouts.index',compact('categories', 'randomUsers', 'randomCampaigns', 'staffPickCampaign', 'staffPickCategory'));
    }


    //info
    public function viewDieuKhoanChung() {
      return view('infos.cac-dieu-khoan-chung');
    }

    public function viewChiPhi() {
      return view('infos.chi-phi-goi-von');
    }

    public function viewHoanTra() {
      return view('infos.quy-dinh-hoan-tra');
    }

    public function viewChinhSachBaoMat() {
      return view('infos.chinh-sach-bao-mat');
    }

    public function viewHuongDanSuDung() {
      return view('infos.huong-dan-su-dung');
    }
}
