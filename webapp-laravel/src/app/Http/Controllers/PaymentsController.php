<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Booking;
use App\Models\Payment;

class PaymentsController extends Controller
{
    public function payview(Request $request) {

		$incomingFields = $request->validate([
            'booking_code' => 'required|max:255' // XOISAD2
        ]);

        $booking = Booking::where('booking_code',$incomingFields['booking_code'])->first();
        // get amount
        $booking->amount;
        // check payments (sum them up)
        // show remaining sum and details of the journey

		return view('pay')->with([
			'booking' => $booking
		]);
	}

    public function pay(Request $request) {

		$incomingFields = $request->validate([
            "cardName" => 'required|max:255',
            "cardNumber" => 'required|max:255',
            "expiryDate" => 'required|max:16',
            "cvv" => 'required|max:10',
            "booking_code" => 'required|max:20'
        ]);

        // get booking for the amount
        $booking = Booking::where('booking_code',$incomingFields['booking_code'])->first();

        // validate card

        // issue payment api
        $payment_data = $this->payment_api($incomingFields['cardName'], 
                                           $incomingFields['cardNumber'], 
                                           $incomingFields['expiryDate'], 
                                           $incomingFields['cvv'],
                                           $booking->amount);

        $payment = new Payment;
        $payment->card_holder_name = $incomingFields['cardName'];
        $payment->expiry_date = $incomingFields['expiryDate'];
        $payment->pan = $payment_data['pan'];
        $payment->service_code = 
        $payment->amount = $payment_data['amount'];
        $payment->booking_id = $booking->id;
        $payment->save();

        return view('congrats', [
            'payment_reference' => $payment->id,
            'booking_code' => $booking->booking_code
        ]); // TODO
	}

    function payment_api($card_name, $card_number, $exp, $cvv, $amount) {
        // issue the real payment
        // careful with the payment data

        // TADAAAA

        return [
            'pan' => "PA0X",
            'service_code' => "2",
            'amount' => $amount, // MOCK
        ];
    }

}
