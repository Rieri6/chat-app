<?php
require '../config/koneksi.php';

$stmt = $pdo->query("SELECT * FROM chats");
$chats = $stmt->fetchAll();


$stmt =  $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $chat_id = $_POST['chat_id'];
    $user_id = $_POST['user_id'];
    $message = $_POST['message'];

    $stmt =  $pdo->prepare("INSERT INTO messages (chat_id, user_id, message) VALUES (?,?,?)");
    $stmt->execute([$chat_id, $user_id, $message]);

    header('Location: read_messages.php?chat_id=$chat_id');
}
?>

<form method="POST">
    Chat:
    <select name="chat_id" id="">
    <?php foreach ($chats as $chat) :?>
    <option value="<?= $chat['id']?>"><?= $chat['chat_name'] ?></option>
    <?php endforeach; ?>
    </select>
    User:
    <select name="user_id" id="">
    <?php foreach ($users as $user) :?>
    <option value="<?= $user['id']?>"><?= $user['username'] ?></option>
    <?php endforeach; ?>
    </select>
    Message : <textarea name="message" require></textarea>
    <button type="sumbit">Kirim</button>
</form>