<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

class QuotaController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Frontend/Quota/Index', 
        [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register')
        ]);
    }

    public function check(Request $request)
    {
        $data = Booking::where('check_in', $request->check_in_date)->count();
        $status = $data >= 100 ? 'Full' : 'Available';
        return Inertia::render('Frontend/Quota/Index', 
        [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'data' => $data, 
            'quota' => 100, 
            'status' => $status
        ]);
    }
}
