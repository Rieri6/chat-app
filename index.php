<?php
session_start();
if(!isset($_SESSION['iduser'])){
    header("Location: login.php");
    exit();
}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Tampilan Chat Room</title>
</head>
<body>
         <div class="chat-container">
        <div class="chat-list">
        </div>
        <div class="chat-box">
            <div class="chat-header">
                <h3 id="chat-title">Pilih chat untuk memulai</h3>
            </div>
            <div class="chat-messages" id="messages">
            </div>
            <div class="chat-input">
                <form id="message-form" action="modules/create_message.php" method="POST">
                    <input type="hidden" name="chat_id" id="chat_id">
                    <input type="text" name="message" placeholder="Tulis pesan...">
                    <button type="submit">Kirim</button>
                    <a href="login.php">balik login</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php } ?>