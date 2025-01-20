
const express = require("express");
const http = require('http');
const bodyParser = require("body-parser");
const ws = require('ws');

require("dotenv").config();

const app = express();
app.use(bodyParser.json());

function delay(time) {
  return new Promise(resolve => setTimeout(resolve, time));
} 

async function respond(ws, message) {
	console.log(message);
	var re = /\b(?=[a-zA-Z]*\d)(?=\d*[a-zA-Z])[a-zA-Z\d]{6,12}\b/;
	var result = message.match(re);
	console.log(result);

  	await delay(700); // give it a deep thought
	if(result) {
	   ws.send("searching the entire database");
  	   await delay(400); // give it a deep thought
	   ws.send("Here we go");
	   ws.send(`https://nyanair.example.com/booking?booking_code=${result[0]}`);
	} else {
	   message = message.replace("<", "");
	   message = message.replace(">", "");
	   ws.send(`What do you mean with '${message}'? Please send a booking number`);
	}
}

const welcome = [
    "Hello! How can I help you today?",
    "I'm here to assist you!",
    "Servas!",
    "Do you need help with the booking?",
    "Please tell me your problem."
];
function getWelcome() {
    return welcome[Math.floor(Math.random() * welcome.length)];
}

const wsServer = new ws.WebSocketServer({ port: 3333 });
wsServer.on('connection', (ws) => {
  console.log('new client connected.');
  ws.send(getWelcome());
  ws.on('message', (message) => {
    console.log('Received message:', message.toString());
	respond(ws, message.toString());
    });

  // Event listener for client disconnection
  ws.on('close', () => {
    console.log('A client disconnected.');
  });
});

app.listen(3000, () => {
  console.log("Server is running on port 3000");
});
