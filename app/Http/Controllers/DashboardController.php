<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
   public function index() {

    $ideas = Idea::orderBy("created_at","desc");

    if(request()->has("search")){
      $ideas = $ideas->search(request('search', ''));
    }

    return view("dashboard", [
      "ideas"=> $ideas->paginate(5)
    ]);
   }
}
