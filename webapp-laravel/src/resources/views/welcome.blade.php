<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
            overflow: hidden;
        }

        .welcome-container {
            text-align: center;
            animation: fadeIn 2s ease-in-out;
        }

        .rocket {
            font-size: 100px;
            margin-bottom: 20px;
            animation: bounce 2s infinite;
        }

        .welcome-text {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .book-now-btn {
            font-size: 1.2rem;
            padding: 10px 30px;
            border: none;
            border-radius: 25px;
            background: #ff7e5f;
            color: #fff;
            text-transform: uppercase;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .book-now-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes flyAway {
            0% {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
            30% {
                transform: translateY(-150px) scale(1.5);
                opacity: 0.9;
            }
            60% {
                transform: translateY(-500px) scale(2);
                opacity: 0.6;
            }
            100% {
                transform: translateY(-1000px) scale(0.5);
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <div class="rocket" id="rocket">
            🚀
        </div>
        <div class="welcome-text">
            Welcome to Your Next Adventure!
        </div>
        <button class="book-now-btn" onclick="animateRocket()">Book Now</button>
    </div>

    <script>
        function animateRocket() {
            const rocket = document.getElementById('rocket');
            rocket.style.animation = 'flyAway 3s forwards';
            setTimeout(function () {
                window.location.href = "/search";
            }, 3000);
        }
    </script>
</body>
</html>
