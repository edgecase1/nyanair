<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airport;

class AirportController extends Controller
{
    public function search(Request $request) {
        $incomingFields = $request->validate([
            'search' => 'required|max:255',
        ]);

        $searchTerm = strip_tags($incomingFields['search']);

        $results = Airport::query()
            ->where('code', 'LIKE', "%{$searchTerm}%") 
            ->orWhere('icao', 'LIKE', "%{$searchTerm}%") 
            ->orWhere('name', 'LIKE', "%{$searchTerm}%") 
            ->orWhere('city', 'LIKE', "%{$searchTerm}%") 
            ->limit(7)
            ->get();
        return response()->json($results);
    }

    public function importCsv(Request $request)
    {
        $incomingFields = $request->validate([
            'file' => 'required|max:255',
        ]);
        $csvFile = $incomingFields['file'];

        $fileD = fopen($csvFile,"r");
        $column=fgetcsv($fileD);
        while(!feof($fileD)){
            $rowData[]=fgetcsv($fileD);
        }
        foreach ($rowData as $key => $value) {
            $airport = new Airport();
            $airport['code'] = $value[0];
            $airport['icao'] = $value[1];
            $airport['name'] = $value[2];
            $airport['latitude'] = $value[3];
            $airport['longitude'] = $value[4];
            $airport['elevation'] = $value[5];
            $airport['url'] = $value[6];
            $airport['time_zone'] = $value[7];
            $airport['city_code'] = $value[8];
            $airport['country'] = $value[9];
            $airport['city'] = $value[10];
            $airport['state'] = $value[11];
            $airport['county'] = $value[12];
            $airport['type'] = $value[13];
            $airport->save();
        }
        print_r($rowData);
    }
    
}
