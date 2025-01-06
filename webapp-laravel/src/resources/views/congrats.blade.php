<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            font-family: 'Arial', sans-serif;
            text-align: center;
            padding: 50px 20px;
        }

        .congrats-container {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            padding: 30px;
            max-width: 600px;
            margin: 0 auto;
        }

        .congrats-container h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .congrats-container p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .checkmark {
            font-size: 4rem;
            color: #00ff88;
            margin-bottom: 20px;
        }

        .btn-home {
            background-color: #00ff88;
            color: #fff;
            font-size: 1.2rem;
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-home:hover {
            background-color: #00cc70;
            text-decoration: none;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="congrats-container">
        <i class="fas fa-check-circle checkmark"></i>
        <h1>Congratulations!</h1>
        <p>Your booking has been successfully confirmed.</p>
        <p>Thank you for choosing our service. We look forward to serving you!</p>
        <p>Your payment reference is {{$payment_reference}} for booking code {{$booking_code}}.</p>
        <a href="/" class="btn-home">Return to Home</a>
    </div>
</body>
</html>