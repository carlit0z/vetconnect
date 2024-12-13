<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .chat-container {
            width: 90%;
            max-width: 500px;
            height: 80%;
            display: flex;
            flex-direction: column;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .chat-header {
            padding: 15px;
            background-color: #007BFF;
            color: white;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px 8px 0 0;
        }

        .chat-messages {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            background-color: #f9f9f9;
        }

        .message {
            margin-bottom: 10px;
            display: flex;
        }

        .message .bubble {
            padding: 10px;
            border-radius: 10px;
            max-width: 70%;
        }

        .message.sent .bubble {
            background-color: #007BFF;
            color: white;
            margin-left: auto;
        }

        .message.received .bubble {
            background-color: #e9e9e9;
            color: #333;
        }

        .chat-input {
            display: flex;
            padding: 10px;
            border-top: 1px solid #ddd;
            background-color: #fff;
            border-radius: 0 0 8px 8px;
        }

        .chat-input input {
            flex: 1;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
        }

        .chat-input button {
            margin-left: 10px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .chat-input button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="chat-container">
        <div class="chat-header">Chat Room</div>
        <div class="chat-messages" id="chatMessages">
            <!-- Messages will appear here -->
        </div>
        <div class="chat-input">
            <input type="text" id="messageInput" placeholder="Type a message...">
            <button id="sendButton">Send</button>
        </div>
    </div>

    <script>
        const messageInput = document.getElementById('messageInput');
        const sendButton = document.getElementById('sendButton');
        const chatMessages = document.getElementById('chatMessages');

        function addMessage(text, type = 'sent') {
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('message', type);

            const bubbleDiv = document.createElement('div');
            bubbleDiv.classList.add('bubble');
            bubbleDiv.textContent = text;

            messageDiv.appendChild(bubbleDiv);
            chatMessages.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        sendButton.addEventListener('click', () => {
            const messageText = messageInput.value.trim();
            if (messageText !== '') {
                addMessage(messageText, 'sent');
                messageInput.value = '';

                // Simulate a response after a delay
                setTimeout(() => {
                    addMessage('This is an automated response.', 'received');
                }, 1000);
            }
        });

        messageInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                sendButton.click();
            }
        });
    </script>
</body>

</html>