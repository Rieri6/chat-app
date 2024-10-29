<?php
require "../config/koneksi.php";

$chat_id = $_GET['chat_id'];
$stmt = $pdo->prepare("SELECT * FROM messages WHERE chat_id = ?");
$stmt->execute([$chat_id]);
$message = $stmt->fetch();
?>

<table>
    <tr>
        <td>ID</td>
        <td>User</td>
        <td>Message</td>
        <td>Waktu</td>
    </tr>
    <?php foreach($messages as $message):?>
        <tr>
            <td><?= $message['id']?></td>
            <td>
                <?php
                $user_stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
                $user_stmt->execute([$message['user_id']]);
                $user = $user_stmt->fetch();
                echo $user['Username'];
                ?>
            </td>
            <td><?= $message['message']?></td>
            <td><?= $message['created_at']?></td>
        </tr>
        <?php endforeach; ?>
</table>