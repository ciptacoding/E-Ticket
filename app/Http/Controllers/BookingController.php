<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index(Request $request)
    {   
       
        return Inertia::render('Frontend/Booking/Index', 
        [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register')
        ]);
    }

    public function pay(Request $request)
    {
        $request->request->add(['total_price' => 25000, 'status' => 'Unpaid']);
        $booking = Booking::create($request->all());  
        
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $booking->id,
                'gross_amount' => $booking->total_price,
            ),
            'customer_details' => array(
                'first_name' => $booking->full_name,
                'phone' => $booking->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $clientKey = config('midtrans.client_key');
        // dd($clientKey);
        return Inertia::render('Frontend/Booking/OrderDetail', 
        [
            'booking' => $booking,
            'snapToken' => $snapToken,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'clientKey' => $clientKey
        ]);
    }
}
