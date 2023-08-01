<?php

namespace App\Http\Controllers;

use App\Models\Entrance;
use App\Models\Booking;
use Inertia\Inertia;
use Illuminate\Http\Request;

class EntranceController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::query()->where('status', 'Paid');
        $entrances = $query->when($request->input('search'), function ($query, $search) {
            $query->where('full_name', 'like', '%' . $search . '%');
        })->paginate(6)->withQueryString();

        return Inertia::render('Dashboard/Entrance/Index',
        [
            'entrances' => $entrances,
            'filters' => $request->only(['search'])
        ]);
    }
}
