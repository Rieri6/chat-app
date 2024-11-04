<?php
session_start();
require "../config/koneksi.php";

$chat_id = $_GET['chat_id'] ?? null;

if ($chat_id) {
    $stmt = $pdo->prepare("SELECT messages.message, messages.created_at, users.username 
                           FROM messages 
                           JOIN users ON messages.user_id = users.id 
                           WHERE messages.chat_id = ? 
                           ORDER BY messages.created_at ASC");
    $stmt->execute([$chat_id]);
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $currentUsername = $_SESSION['username'] ?? '';

    foreach ($messages as $message) {
        $class = ($message['username'] == $currentUsername) ? 'message-right' : 'message-left';
        echo "<div class='message-box $class'>";
        echo "<strong>" . htmlspecialchars($message['username']) . "</strong>";
        echo "<p>" . htmlspecialchars($message['message']) . "</p>";
        echo "<small class='text-muted'>" . $message['created_at'] . "</small>";
        echo "</div>";
    }
}
