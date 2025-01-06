<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Search</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('https://source.unsplash.com/1600x900/?airplane,sky');
            background-size: cover;
            background-position: center;
            color: #333;
        }
        
        /* Page Container */
        .container {
            max-width: 800px;
            margin: 100px auto;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            color: #007BFF;
        }

        p {
            font-size: 1.2em;
            color: #555;
        }

        /* Form Styles */
        form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            margin-top: 20px;
        }
        
        input, select {
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: calc(50% - 20px);
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            font-size: 1em;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Footer */
        footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #666;
        }

        .autocomplete-items {
          align-self: flex-start;
          min-width:180px;
        }

        .autocomplete-item:hover {
          background-color: #D5FFFF;
        }


    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Main Container -->
    <div class="container">
        <h1>Take a leap!</h1>
        <p>enter your international airports and a date to book a Jumper</p>

        <!-- Search Form -->
        <form action="/search" method="post" autocomplete="off">
            <div style="position: relative; display: inline-block; width: calc(50% - 30px);">
                <input id="from" name="from" type="text" placeholder="From (City or Airport)" required>
                <div id="fromDropdown" class="autocomplete-items"></div>
            </div>
            <div style="position: relative; display: inline-block; width: calc(50% - 30px);">
                <input id="to" name="to" type="text" placeholder="To (City or Airport)" required>
                <div id="toDropdown" class="autocomplete-items"></div>
            </div>
            <div>
                passengers<input type="number" style="width:60px;" id="passengercount" name="passengercount" min="1" max="3" />
                <input type="date" style="width:150px;" name="departure" id="departure" placeholder="Departure Date" required>
            </div>
            @csrf
            <button type="submit">Search Flights</button>
        </form>

        <!-- Footer -->
        <footer>
            <p>&copy; 2024 FlightFinder. All Rights Reserved.</p>
        </footer>
    </div>

    <script>
      $(document).ready(function() {
          function autocomplete(inputId, dropdownId) {
              $(inputId).on('input', function() {
                  const query = $(this).val();
                  const dropdown = $(dropdownId);
                  dropdown.empty();

                  if (query.length >= 3) {
                      $.ajax({
                          url: '/airports', // Replace with actual API
                          method: 'GET',
                          data: { search: query, order: 'county'},
                          success: function(response, request) {
                              response.forEach(item => {
                                  dropdown.append(`<div class="autocomplete-item">${item['code']} ${item['name']}</div>`);
                              });
                          },
                          error: function() {
                              console.log("Error fetching data");
                          }
                      });
                  }
              });

              $(dropdownId).on('click', 'div', function() {
                  $(inputId).val($(this).text());
                  $(dropdownId).empty();
              });
          }

          autocomplete('#from', '#fromDropdown');
          autocomplete('#to', '#toDropdown');
      });
    </script>
</body>
</html>
