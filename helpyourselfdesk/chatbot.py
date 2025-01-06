from chatterbot import ChatBot
from chatterbot.trainers import ChatterBotCorpusTrainer

# Create a new chatbot instance
chatbot = ChatBot('MyChatBot')

# Set up the trainer
trainer = ChatterBotCorpusTrainer(chatbot)

# Train the chatbot on the English corpus
trainer.train('chatterbot.corpus.english')

# Function to chat with the bot
def chat():
    print("Hello! I'm your chatbot. Type 'exit' to end the conversation.")
    
    while True:
        try:
            # Get user input
            user_input = input("You: ")
            
            # Check for exit condition
            if user_input.lower() == 'exit':
                print("Goodbye!")
                break
                
            # Get a response from the chatbot
            response = chatbot.get_response(user_input)
            print(f"Bot: {response}")
        
        except (KeyboardInterrupt, EOFError, SystemExit):
            break

# Start chatting
if __name__ == "__main__":
    chat()
