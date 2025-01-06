<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airport;

class FlightsController extends Controller
{
	public function search(Request $request) {

		$incomingFields = $request->validate([
            'from' => 'required|max:255', // VIE+Vienna+International+Airport
			'to' => 'required|max:255', // EBJ+Esbjerg+Airport
			'departure' => 'required|max:255', // date 2024-12-03
			'passengercount' => 'required'
        ]);

		$departure = date_parse_from_format('Y-m-d', $request->post('departure'));

		$from = explode(" ", $request->post('from'), 2);
		$from_airport = Airport::where('code',$from[0])->first();

		$to = explode(" ", $request->post('to'), 2);
		$to_airport = Airport::where('code',$to[0])->first();

		return view('results')->with([
			'from' => $from,
			'from_airport' => $from_airport,
			'to' => $to,
			'to_airport' => $to_airport,
			'departure' => $departure['day'] . ".". $departure['month'] . "." . $departure['year'],
			'passengercount' => $incomingFields['passengercount']
		]);
	}
}
