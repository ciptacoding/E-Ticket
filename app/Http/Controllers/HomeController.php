<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Post;
use App\Models\Blacklist;

class HomeController extends Controller
{
    public function index (Request $request)
    {
        $posts = Post::orderByDESC('date_post')->paginate(6);

        return Inertia::render('Frontend/Home/Index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'posts' => $posts,
            'blacklists' => Blacklist::query()
                ->when($request->input('search'), function($query, $search){
                    $query->where('full_name', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%');
                })->orderByDESC('id')->paginate(6)->withQueryString(),
                'filters' => $request->only(['search'])
        ]);
    }
}
