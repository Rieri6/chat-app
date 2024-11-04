<?php
session_start();
require "../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $chat_id = $_POST['chat_id'];
    $user_id = $_SESSION['iduser'] ?? null; 
    $message = trim($_POST['message']);

    if ($user_id && $chat_id && !empty($message)) {
        $stmt = $pdo->prepare("INSERT INTO messages (chat_id, user_id, message, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$chat_id, $user_id, $message]);

        header("Location: ../index.php?chat_id=$chat_id");
        exit();
    } else {
        echo "Gagal mengirim pesan. Pastikan semua data diisi." ;
    }
}
