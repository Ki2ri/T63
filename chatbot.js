document.addEventListener("DOMContentLoaded", function () {
  const chatButton = document.createElement("button");
  chatButton.id = "chat-toggle";
  chatButton.innerText = "Chat";

  const chatBox = document.createElement("div");
  chatBox.id = "chat-box";
  chatBox.innerHTML = `
    <div id="chat-header">Game Haven Assistant</div>
    <div id="chat-messages">
      <div class="bot-message">Hi, I can help you find products and answer store questions.</div>
    </div>
    <div id="chat-input-area">
      <input type="text" id="chat-input" placeholder="Ask something..." />
      <button id="chat-send">Send</button>
    </div>
  `;

  document.body.appendChild(chatButton);
  document.body.appendChild(chatBox);

  chatButton.addEventListener("click", () => {
    chatBox.style.display = chatBox.style.display === "flex" ? "none" : "flex";
  });

  function addMessage(text, sender) {
    const msg = document.createElement("div");
    msg.className = sender === "user" ? "user-message" : "bot-message";
    msg.textContent = text;
    document.getElementById("chat-messages").appendChild(msg);
    document.getElementById("chat-messages").scrollTop = document.getElementById("chat-messages").scrollHeight;
  }

  async function sendMessage() {
    const input = document.getElementById("chat-input");
    const message = input.value.trim();
    if (!message) return;

    addMessage(message, "user");
    input.value = "";

    try {
      const response = await fetch("chatbot.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({ message })
      });

      const data = await response.json();
      addMessage(data.reply || "Sorry, something went wrong.", "bot");
    } catch (error) {
      addMessage("Sorry, I could not connect right now.", "bot");
    }
  }

  document.getElementById("chat-send").addEventListener("click", sendMessage);
  document.getElementById("chat-input").addEventListener("keypress", function (e) {
    if (e.key === "Enter") sendMessage();
  });
});
