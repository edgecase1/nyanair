<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlightsController extends Controller
{
	public function search(Request $request) {

		$incomingFields = $request->validate([
            'from' => 'required|max:255', // VIE+Vienna+International+Airport
			'to' => 'required|max:255', // EBJ+Esbjerg+Airport
			'departure' => 'required|max:255', // date 2024-12-03
			'return' => 'required|max:255', // date 2024-12-03
        ]);

		return view('results');
	}
}
