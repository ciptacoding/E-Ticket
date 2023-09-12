<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Entrance;
use App\Models\Blacklist;
use App\Models\Booking;
use App\Models\Suggestion;
use Inertia\Inertia;

class DashboardDetailController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('role', 'user')->count();
        $posts = Post::count();
        $entrances = Entrance::where('status_entrances', 'Check In')->count();
        $transactions = Booking::count();
        $blacklists = Blacklist::count();
        $suggestions = Suggestion::count();
        
        $data = [
            'users' => $users, 
            'posts' => $posts, 
            'entrances' => $entrances, 
            'transactions' => $transactions, 
            'blacklists' => $blacklists,
            'suggestions' => $suggestions,
        ];

        return Inertia::render('Dashboard/Overview/Index', ['data' => $data]);
    }
}
