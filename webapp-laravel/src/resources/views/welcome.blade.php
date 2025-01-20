<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
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

        .btn {
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

        .btn:hover {
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

      /* Chat Widget Styles */
        .chat-widget {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 300px;
            max-height: 400px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            overflow: hidden;
            display: none;
            flex-direction: column;
        }

        .chat-widget-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            font-size: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-widget-header button {
            background: none;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
        }

        .chat-widget-messages {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            background-color: #f9f9f9;
        }

        .chat-widget-input {
            display: flex;
            border-top: 1px solid #ddd;
            padding: 10px;
            background-color: #fff;
        }

        .chat-widget-input input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        .chat-widget-input button {
            margin-left: 10px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .chat-widget-input button:hover {
            background-color: #0056b3;
        }

        .chat-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            font-size: 24px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .chat-toggle:hover {
            background-color: #0056b3;
        }

        .waiting-animation {
            display: none;
            margin-top: 10px;
            text-align: center;
            font-style: italic;
            color: #888;
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
        <button class="btn" onclick="animateRocket()">Book Now</button>
        <button class="btn" onclick="window.location.href = '/checkin'">Check in</button>
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

    <div class="chat-widget" id="chatWidget">
        <div class="chat-widget-header">
            Chat with us!
            <button id="closeChat">&times;</button>
        </div>
        <div class="chat-widget-messages" id="chatMessages">
            <!-- Messages will appear here -->
        </div>
        <div class="waiting-animation" id="waitingAnimation">Waiting for response...</div>
        <div class="chat-widget-input">
            <input type="text" id="chatInput" placeholder="Type your message...">
            <button id="sendMessage">Send</button>
        </div>
    </div>

    <button class="chat-toggle" id="chatToggle">&#128172;</button>

    <script>
        $(document).ready(function() {
            // Initialize WebSocket
            const socket = new WebSocket('wss://nyanair.example.com/chat');

            socket.onopen = function() {
                console.log('WebSocket is connected.');
            };

            socket.onmessage = function(event) {
                // Hide waiting animation
                $('#waitingAnimation').hide();

                const messageElement = `<div style="margin-bottom: 10px;"><strong>Joda:</strong> ${event.data}</div>`;
                $('#chatMessages').append(messageElement);
                $('#chatMessages').scrollTop($('#chatMessages')[0].scrollHeight);
            };

            socket.onerror = function(error) {
                console.error('WebSocket error:', error);
            };

            socket.onclose = function() {
                console.log('WebSocket is closed.');
            };

            // Toggle chat visibility
            $('#chatToggle').click(function() {
                $('#chatWidget').fadeIn();
                $(this).hide();
            });

            $('#closeChat').click(function() {
                $('#chatWidget').fadeOut();
                $('#chatToggle').show();
            });

            // Send message
            $('#sendMessage').click(function() {
                const message = $('#chatInput').val().trim();
                if (message) {
                    const messageElement = $('<div style="margin-bottom: 10px;"></div>');
                    messageElement.text(`You: ${message}`);
                    $('#chatMessages').append(messageElement);
                    $('#chatMessages').scrollTop($('#chatMessages')[0].scrollHeight);
                    $('#chatInput').val('');

                    // Show waiting animation
                    $('#waitingAnimation').show();

                    // Send message via WebSocket
                    socket.send(message);
                }
            });

            // Handle enter key press
            $('#chatInput').keypress(function(e) {
                if (e.which === 13) {
                    $('#sendMessage').click();
                }
            });
        });
    </script>

</body>
</html>
