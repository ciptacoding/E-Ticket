<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Inertia\Inertia;
use Illuminate\Http\Request;

class EntranceController extends Controller
{
    public function index(Request $request, Booking $booking) 
    {
        $query = Booking::query()->where('status', 'Paid');
        $entrances = $query->when($request->input('search'), function ($query, $search) {
            $query->where('full_name', 'like', '%' . $search . '%')
            ->orWhere('check_in', 'like', '%'.$search.'%')
            ->orWhere('check_out', 'like', '%'.$search.'%')
            ->orWhere('status_entrance', 'like', '%'.$search.'%');
        })->paginate(6)->withQueryString();

        return Inertia::render('Dashboard/Entrance/Index',
        [
            'entrances' => $entrances,
            'filters' => $request->only(['search']),
        ]);
    }

    public function checkin(Request $request)
    {
        Booking::where('id', $request->id)->update(['status_entrance' => 'Check In']);
        return back()->with('message', 'Check-In Successfully!');
    }

    public function checkout(Request $request)
    {
        Booking::where('id', $request->id)->update(['status_entrance' => 'Check Out']);
        return back()->with('message', 'Check-Out Successfully!');
    }

    public function blacklist(Request $request)
    {
        Booking::where('id', $request->id)->update(['status_entrance' => 'Blacklist']);

        $data = Booking::findOrFail($request->id);
        return Inertia::render('Dashboard/Entrance/Blacklist',
        [
            'data' => $data
        ]);
    }
}
