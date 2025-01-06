# Use an official Python runtime as a base image
FROM python:3.9-slim

# Set the working directory inside the container
WORKDIR /app

# Copy the current directory contents into the container at /app
COPY . /app

RUN apt-get update -y && apt-get install gcc -y

# Install any needed packages specified in requirements.txt
RUN pip install --no-cache-dir -r requirements.txt

# Install ChatterBot and ChatterBotCorpus
RUN pip install chatterbot chatterbot_corpus

# Make port 5000 available to the world outside this container (optional for web app)
EXPOSE 5000

# Run chatbot.py when the container starts
CMD ["python", "chatbot.py"]
