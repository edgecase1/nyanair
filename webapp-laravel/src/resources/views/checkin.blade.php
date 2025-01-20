<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NyanAir Check-In</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #89cff0, #ffb6c1);
      color: #333;
      text-align: center;
      padding: 20px;
    }
    header {
      margin-bottom: 20px;
    }
    header img {
      width: 150px;
    }
    h1 {
      color: #ff69b4;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    }
    form {
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      padding: 20px;
      max-width: 400px;
      margin: 0 auto;
    }
    label {
      display: block;
      margin: 10px 0 5px;
      font-weight: bold;
    }
    input, button {
      width: calc(100% - 20px);
      padding: 10px;
      margin-bottom: 15px;
      border: 2px solid #ff69b4;
      border-radius: 5px;
    }
    button.submit {
      background: #ff69b4;
      color: white;
      font-size: 16px;
      cursor: pointer;
    }
    button.checkin {
      background: green;
      color: white;
      font-size: 16px;
      cursor: pointer;
      width:120px;
    }
    button:hover {
      background: #ff85c1;
    }
    footer {
      margin-top: 20px;
      font-size: 14px;
      color: #555;
    }
    .success-message {
      color: #2ecc71;
      font-weight: bold;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <header>
    <img src="https://www.nyan.cat/cats/original.gif" alt="NyanAir Logo">
    <h1>Welcome to NyanAir Check-In</h1>
    <p>The only airline that flies you to space in style!</p>
  </header>
  <form id="checkinForm">
    <label for="name">Passenger Name</label>
    <input type="text" id="name" name="surname" placeholder="Enter your full name" required>

    <label for="bookingCode">Booking Code</label>
    <input type="text" id="bookingCode" name="booking_code" placeholder="e.g., NYA234" required>

    <div id="passengerList"></div>

    <button type="submit" class="submit">Check In</button>
  </form>
  <p id="confirmationMessage" class="success-message" style="display: none;">Check-in successful! Enjoy your flight on NyanAir!</p>

  <footer>
    © 2024 NyanAir | Fly with joy, powered by rainbows and rockets.
  </footer>

  <script>
     function checkin(id) {
        $.ajax({
          url: 'http://localhost:5000/checkin',
          method: 'POST'
        }).done(function(data, textStatus, jqXHR) {
            alert("checkin done");
        }).fail(function(jqXHR, textStatus, errorThrown) {
            alert("checkin fail");
        });
    }

   $(document).ready(function() {
      $('#checkinForm').submit(function(event) {
        event.preventDefault(); // Prevent form submission to the server

        const formData = $(this).serialize();
        const url = 'http://localhost:5000/bookings';
        $.ajax({
          url: `${url}?${formData}`,
          method: 'GET'
        }).done(function(data, textStatus, jqXHR) {
            $('#confirmationMessage').show();
            const passengerList = $('#passengerList');
            passengerList.empty(); // Clear existing list
            const obj = JSON.parse(data);
            obj.forEach(function (passenger) {
              const item = `
                <div class="passenger-item">
                  <span>${passenger.name}</span>
		  <button class="checkin" onclick="checkin(${passenger.id})">check in</button>
                </div>
              `;
              passengerList.append(item);
            });
            passengerList.show();
        }).fail(function(jqXHR, textStatus, errorThrown) {
            $('#confirmationMessage').html(jqXHR.responseText);
            $('#confirmationMessage').show();
        });
      });
    });
  </script>
</body>
</html>
