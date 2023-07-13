<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Post;

class HomeController extends Controller
{
    public function index ()
    {
        $posts = Post::orderByDESC('date_post')->paginate(6);

        return Inertia::render('Frontend/Home/Index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'posts' => $posts
        ]);
    }
}
