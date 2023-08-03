<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Suggestion;

class SuggestionController extends Controller
{
    public function index()
    {
        return Inertia::render('Frontend/Suggestions/Index', 
        [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register')
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'comment' => 'required|min:10',
            'suggestion' => 'required|min:10'
        ]);

        Suggestion::create([
            'user_id' => $request->user_id,
            'comment' => $request->comment,
            'suggestion' => $request->suggestion,
        ]);

        return redirect()->route('suggestion.index')->with('success', 'Message has been sending');
    }
}
