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
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(120deg, #f6d365, #fda085);
            color: #333;
            text-align: center;
        }

        h1 {
            color: #fff;
            margin-top: 20px;
            font-size: 2.5rem;
        }

        p {
            color: #fff;
            font-size: 1.2rem;
        }

        #map {
            width: 90%;
            height: 500px;
            margin: 20px auto;
            border: 3px solid #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        form {
            margin: 20px auto;
        }

        input[type="submit"] {
            background: #6a11cb;
            background: -webkit-linear-gradient(to right, #2575fc, #6a11cb);
            background: linear-gradient(to right, #2575fc, #6a11cb);
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s;
        }

        input[type="submit"]:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .leaflet-popup-content {
            font-size: 1rem;
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Your Flight Journey</h1>
    <p>
        On <strong>{{$departure}}</strong>, travel from 
        <strong>{{$from[1]}} ({{$from_airport->longitude}}, {{$from_airport->latitude}})</strong> to 
        <strong>{{$to[1]}} ({{$to_airport->longitude}}, {{$to_airport->latitude}})</strong>.
    </p>
    
    <form action="/book" method="get">
        <input type="hidden" name="from" value={{$from_airport->code}}>
        <input type="hidden" name="to" value={{$to_airport->code}}>
        <input type="hidden" name="departure" value={{$departure}}>
        <input type="hidden" name="passengercount" value={{$passengercount}}>
        <input type="submit" name="action" value="Book Now">
    </form>

    <div id="map"></div>

    <script>
        // Initialize the map
        const map = L.map('map', {
            minZoom: 4,
            maxZoom: 22,
            zoomSnap: 0.5
        }).setView([0, 0], 4);

        // Add OpenStreetMap tiles with an attribution
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 20,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Define two coordinates
        const coord1 = [{{$from_airport->latitude}}, {{$from_airport->longitude}}];
        const coord2 = [{{$to_airport->latitude}}, {{$to_airport->longitude}}];

        // Add markers with animations
        const marker1 = L.marker(coord1, { riseOnHover: true })
            .addTo(map)
            .bindTooltip("{{$from_airport->name}}", { direction: "top", offset: [0, -10] })
            .openTooltip();

        const marker2 = L.marker(coord2, { riseOnHover: true })
            .addTo(map)
            .bindTooltip("{{$to_airport->name}}", { direction: "top", offset: [0, -10] });

        map.setView(marker1.getLatLng(),5);

        // Add a curved line using leaflet-curve
        const curvedLine = L.curve(
            [
                'M', coord1, // Move to the first point
                'Q', // Quadratic Bezier curve
                [(coord1[0] + coord2[0]) / 2 + 10, (coord1[1] + coord2[1]) / 2], // Control point offset for a natural curve
                coord2 // End point
            ],
            {
                color: '#2575fc',
                weight: 4,
                dashArray: '5, 10',
                opacity: 0.8,
                lineJoin: 'round',
            }
        ).addTo(map);
    </script>
</body>
</html>
