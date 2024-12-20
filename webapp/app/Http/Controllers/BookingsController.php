<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Booking;

class BookingsController extends Controller
{
    public function bookview(Request $request) {

		$incomingFields = $request->validate([
            'from' => 'required',
			'to' => 'required',
			'departure' => 'required'
        ]);

		return view('book');
	}

    public function book(Request $request) {

        $incomingFields = $request->validate([
            'from' => 'required', // FK airport
			'to' => 'required',   // FK airport
			'departure' => 'required',
            // invoice
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            // passengers
            'passengername' => 'required',
            'birthday' => 'required',
            'passport' => 'required'
        ]);

        $booking_code = 'XFF2AAC'; // make it random

        $incomingFields['booking_code'] = $booking_code;
        Booking::create($incomingFields);

        return redirect('/pay', $booking_code);
    }
}
