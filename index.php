<?php
session_start();
require 'config/koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$currentUsername = $_SESSION['username'];
$chat_id = $_GET['chat_id'] ?? null;

$stmt = $pdo->query("SELECT * FROM chats");
$chats = $stmt->fetchAll();

$messages = [];
if ($chat_id) {
    $stmtMessages = $pdo->prepare("SELECT messages.id, messages.message, messages.created_at, users.username 
                                   FROM messages 
                                   JOIN users ON messages.user_id = users.id 
                                   WHERE messages.chat_id = ? 
                                   ORDER BY messages.created_at ASC");
    $stmtMessages->execute([$chat_id]);
    $messages = $stmtMessages->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <title>Chat Room</title>
    <style>
        .message-box {
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 5px;
            max-width: 60%;
        }
        .message-right {
            background-color: #66cc91; 
            margin-left: auto;
            text-align: right;
            width: 40%;
            color: white;
        }
        .message-left {
            background-color: #448dee; 
            text-align: left;
            width: 40%;
            color: white;
        }
        .chat-box {
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <h3 class="text-center">Chat Room</h3>
        <form action="index.php" method="GET" class="mb-3">
            <select name="chat_id" class="form-select me-2" onchange="this.form.submit()">
                <?php foreach ($chats as $chat) : ?>
                    <option value="<?= $chat['id']; ?>" <?= ($chat_id == $chat['id']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($chat['chat_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
        <div class="chat-box border rounded p-3" style="height: 500px; overflow-y: auto;" id="chat-box">
            <?php if (!empty($messages)) : ?>
                <?php foreach ($messages as $message) : ?>
                    <?php
                    $class = ($message['username'] === $currentUsername) ? 'message-right' : 'message-left';
                    ?>
                    <div class="d-flex mb-3 <?= $class; ?>">
                        <div class="message-box <?= $class; ?>">
                            <strong><?= htmlspecialchars($message['username']); ?></strong>
                            <p class="mb-1"><?= htmlspecialchars($message['message']); ?></p>
                            <small class="text-muted"><?= $message['created_at']; ?></small>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-center">Tidak ada pesan di chat ini.</p>
            <?php endif; ?>
        </div>
        <form action="modules/create_message.php" method="POST" class="d-flex mt-3">
            <input type="hidden" name="chat_id" value="<?= htmlspecialchars($chat_id); ?>">
            <input type="text" name="message" class="form-control me-2" placeholder="Tulis pesan..." required>
            <button type="submit" class="btn btn-primary">Kirim</button>
            <a href="logout.php" class="btn btn-secondary ms-2">Logout</a>
        </form>
        <form action="modules/create_chat.php" method="POST" class="mt-3">
            <input type="text" name="chat_name" class="form-control" placeholder="Nama Chat Baru" required>
            <button type="submit" class="btn btn-success mt-2">Buat</button>
        </form>
    </div>
    <script>    
        function fetchMessages() {
            const chatBox = document.getElementById('chat-box');
            const chatId = <?= json_encode($chat_id); ?>;

            if (chatId) {
                const xhr = new XMLHttpRequest();
                xhr.open('GET', 'read_message.php?chat_id=' + chatId, true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        chatBox.innerHTML = xhr.responseText;
                        chatBox.scrollTop = chatBox.scrollHeight;
                    }
                };
                xhr.send();
            }
        }

        setInterval(fetchMessages, 3000); 
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
