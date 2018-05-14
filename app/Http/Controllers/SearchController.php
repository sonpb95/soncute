<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Campaign;
use App\Category;
use DB;
use \Illuminate\Pagination\LengthAwarePaginator;
class SearchController extends Controller
{
  public function search(Request $request)
  {
      $result = '';
      $query = '';
      // Making sure the user entered a keyword.
      if($request->has('query')) {
          $query = $request->get('query');
          //$query = utf8_encode($query);
          // Using the Laravel Scout syntax to search the products table.
          if ($query != ''){
            $result = DB::table('campaigns')
                ->where('title', 'like', '%'. $query .'%')
                ->orWhere('pitch', 'like', '%'. $query .'%')
                ->get()->toArray();
            $result = Campaign::hydrate($result);
            //$result = new LengthAwarePaginator($rawResult, $rawResult->count(), 15);
            //dd($result);
            //$result = Campaign::hydrate( $rawResult->items() );
            //$result = Campaign::search($query)->paginate(15);
          }
      }
      $category = new Category;
      $category->id = 0;
      $category->name = 'Khám phá';
      $allCategory = Category::all();
      return view('search.searchResult', compact('result','query','category','allCategory'));
  }
}
