<?php
session_start();
require "../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $chat_name = trim($_POST['chat_name']);

    if (!empty($chat_name)) {
        $stmt = $pdo->prepare("INSERT INTO chats (chat_name) VALUES (?)");
        $stmt->execute([$chat_name]);

        echo "<script>
                alert('Chat berhasil dibuat!');
                window.location.href = '../index.php';
              </script>";
        exit();
    } else {
        echo "Nama chat tidak boleh kosong.";
    }
}
?>
