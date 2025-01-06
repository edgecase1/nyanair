<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Booking;
use App\Models\Passenger;
use App\Models\Airport;

use App\Http\Controllers\PaymentsController;

class BookingsController extends Controller
{
    public function bookview(Request $request) {

		$incomingFields = $request->validate([
            'from' => 'required',
			'to' => 'required',
			'departure' => 'required',
            'passengercount' => 'required'
        ]);

		return view('book')->with([
			'from' => $incomingFields['from'],
			'to' => $incomingFields['to'],
			'departure' => $incomingFields['departure']
		]);
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

        $from_airport = Airport::where('code', $request->post('from'))->first();
        $to_airport = Airport::where('code', $request->post('to'))->first();
        if(is_null($from_airport) || is_null($from_airport)) {
            return response("error", 400);
        }

        $booking = new Booking;
        $booking->booking_code = strtoupper(Str::random(6));
        $booking->name = $request->post('name');
        $booking->address = $request->post('address');
        $booking->city = $request->post('city');
        $booking->country = $request->post('country');
        $booking->from = $from_airport->id;
        $booking->to = $to_airport->id;
        $departure = Carbon::createFromFormat('d.m.Y', $request->post('departure'));
        $booking->departure = $departure;
        $passengers = [];
        foreach($request->post('passengername') as $passenger_id => $x ) {
            $passenger = new Passenger;
            $passenger->name = $request->post('passengername')[$passenger_id];
            $passenger->birthday = $request->post('birthday')[$passenger_id];
            $passenger->passport = $request->post('passport')[$passenger_id];
            $passengers[] = $passenger;
        }
        $booking->amount = 10000; // calculate
        $booking->save(); 
        $booking->passengers()->saveMany($passengers);
        
        return redirect()->action(
            [PaymentsController::class, 'payview'], 
            ['booking_code'=> $booking->booking_code]);
    }
}
