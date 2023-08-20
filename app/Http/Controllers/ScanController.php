<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Booking;
use App\Models\Entrance;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class ScanController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $listTicket = Booking::where('user_id', $userId)->where('status', 'Paid')->with('entrance')->paginate(6);
        return Inertia::render('Frontend/Scan/Index', 
        [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'listTicket' => $listTicket
        ]);
    }

    public function checkIn(Request $request)
    {
        $dateToday = date('Y-m-d');
        if($dateToday !== $request->check_in){
            return back()->with('message', 'Today is not your check in schedule');
        }

        Entrance::create([
            "booking_id" => $request->id,
            "status_entrances" => $request->result
        ]);
            
        return redirect()->route('scan.index')->with('message'. 'Check-in Successfully!');
    }
}
