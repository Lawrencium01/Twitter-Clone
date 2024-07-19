<?php

namespace App\Http\Controllers\Admin;

use App\Models\Idea;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index(){

        $totalUsers = User::count();
        $totalIdeas = Idea::count();
        $totalComment = Comment::count();

        return view("admin.dashboard", compact("totalUsers","totalIdeas","totalComment"));
    }
}
