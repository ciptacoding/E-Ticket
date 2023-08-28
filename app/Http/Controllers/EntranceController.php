<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Entrance;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Http\Request;

class EntranceController extends Controller
{
    public function index(Request $request) 
    {
        $query = Booking::query()->with('entrance')->orderByDesc('check_in')->where('status', 'Paid');
        $entrances = $query->when($request->input('search'), function ($query, $search) {
            $query->where('full_name', 'like', '%' . $search . '%')
            ->orWhere('check_in', 'like', '%'.$search.'%')
            ->orWhere('check_out', 'like', '%'.$search.'%');
        })
        ->when($request->input('date'), function($query, $date) {
                $query->whereDate('check_in', $date);
            })
        ->paginate(6)->withQueryString();

        return Inertia::render('Dashboard/Entrance/Index',
        [
            'entrances' => $entrances,
            'filters' => $request->only(['search']),
        ]);
    }

    public function checkin(Request $request)
    {
        Entrance::create(['booking_id'=> $request->id, 'user_id' => $request->userId, 'status_entrances' => 'Check In', 'gender' => $request->gender]);
        return back()->with('message', 'Check-In Successfully!');
    }

    public function checkout(Request $request)
    {
        Entrance::where('booking_id', $request->id)->update(['status_entrances' => 'Check Out']);
        return back()->with('message', 'Check-Out Successfully!');
    }

    public function scan()
    {
        return Inertia::render('Dashboard/Entrance/Scan');
    }

    public function store(Request $request)
    {
        if(DB::table('entrances')->where('booking_id', $request->bookingNumber)->exists())
        {
            Entrance::where('booking_id', $request->bookingNumber)->update(['status_entrances' => 'Check Out']);
            return redirect('/entrance')->with('message', 'Check-Out Successfully!');
        }else{
            $data = Booking::findOrfail($request->bookingNumber);
            Entrance::create(['booking_id'=> $data->id, 'user_id' => $data->user_id, 'status_entrances' => 'Check In', 'gender' => $data->gender]);
            return redirect('/entrance')->with('message', 'Check-In Successfully!');
        }

    }
}
