<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Post;
use App\Models\Blacklist;
use App\Models\Suggestion;
use App\Models\Booking;
use App\Models\Entrance;

class HomeController extends Controller
{
    public function index (Request $request)
    {
        $posts = Post::with('user')->orderByDESC('date_post')->paginate(8);
        $suggestions = Suggestion::with('user')->get();
        $blacklists = Blacklist::query()->with('user');
        $entrances= Entrance::where('status_entrances', 'Check In')->get();
        
        // dd($suggestions);
        return Inertia::render('Frontend/Home/Index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'total' => $entrances->count(),
            'male' => $entrances->where('gender', 'Male')->count(),
            'female' => $entrances->where('gender', 'Female')->count(),
            'posts' => $posts,
            'suggestions' => $suggestions,
            'blacklists' => $blacklists
                ->when($request->input('search'), function($query, $search){
                    $query->where('full_name', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%');
                })->orderByDESC('id')->paginate(8)->withQueryString(),
            'filters' => $request->only(['search'])
        ]);
    }
}
