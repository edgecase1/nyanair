<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credit Card Payment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .form-container {
            max-width: 400px;
            margin: 2rem auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="form-header">Credit Card Payment</h2>
        <div>
            from {{$booking->from()->first()->name}} to {{$booking->to()->first()->name}} on {{$booking->departure}} amounts {{$booking->amount}}.
        </div>
        <form id="paymentForm" action="/pay" method="post">
            <div class="mb-3">
                <label for="cardName" class="form-label">Cardholder's Name</label>
                <input type="text" class="form-control" id="cardName" name="cardName" placeholder="Enter name on card" required>
            </div>
            <div class="mb-3">
                <label for="cardNumber" class="form-label">Card Number</label>
                <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="expiryDate" class="form-label">Expiry Date</label>
                    <input type="text" class="form-control" id="expiryDate" name="expiryDate" placeholder="MM/YY" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cvv" class="form-label">CVV</label>
                    <input type="password" class="form-control" id="cvv" name="cvv" placeholder="123" required>
                </div>
            </div>
            <input type="hidden" name="booking_code" value="{{$booking->booking_code}}">
            @csrf
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success w-100">Pay Now</button>
            </div>
        </form>
    </div>

    <script>
        
    </script>
</body>
</html>