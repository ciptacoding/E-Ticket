<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Booking;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // $transactions = Booking::all();
        return Inertia::render('Dashboard/Transactions/Index', 
            [
                'transactions' => Booking::query()
                ->when($request->input('search'), function($query, $search){
                    $query->where('full_name', 'like', '%'.$search.'%');
                })->paginate(6)->withQueryString(),
                'filters' => $request->only(['search'])
            ]
        );
    }

    public function show(string $id)
    {
        $transaction = Booking::findOrFail($id);
        return Inertia::render('Dashboard/Transactions/Detail',
        [
            'transaction' => $transaction
        ]);
    }
}
