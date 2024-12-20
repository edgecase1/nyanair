

<!DOCTYPE html>
<html>
<head>
    <title>Leaflet Map with Curved Line</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-curve/leaflet.curve.js"></script>
    <style>
        #map {
            width: 100%;
            height: 500px;
        }
    </style>
</head>
<body>
    <h1>Your Jump</h1>
    <p>on {{$departure}} from {{$from[1]}} ({{$from_airport->longitude}}, {{$from_airport->latitude}}) 
        to {{$to[1]}} ({{$to_airport->longitude}}, {{$to_airport->latitude}})</p>
    
    <form action="/book" method="get">
        <input type="hidden" name="from" value={{$from_airport->code}}>
        <input type="hidden" name="to" value={{$to_airport->code}}>
        <input type="hidden" name="departure" value={{$departure}}>
        <input type="submit" name="action" value="book">
    </form>

    <div id="map"></div>

    <script>
        // Initialize the map
        const map = L.map('map',{
            minZoom: 4,
            maxZoom: 22
        }).setView([0, 0], 4);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 20,
        }).addTo(map);

        // Define two coordinates
        const coord1 = [{{$from_airport->latitude}}, {{$from_airport->longitude}}]; // San Francisco
        const coord2 = [{{$to_airport->latitude}}, {{$to_airport->longitude}}]; // Los Angeles

        // Add markers
        L.marker(coord1).addTo(map).bindPopup("{{$from_airport->name}}").openPopup();
        L.marker(coord2).addTo(map).bindPopup("{{$to_airport->name}}");

        // Add a curved line using leaflet-curve
        const curvedLine = L.curve(
            [
                'M', coord1, // Move to the first point
                'Q', // Quadratic Bezier curve
                [36.5, -120.5], // Control point
                coord2 // End point
            ],
            {
                color: 'blue',
                weight: 3,
                dashArray: '5, 5',
            }
        ).addTo(map);
    </script>
</body>
</html>