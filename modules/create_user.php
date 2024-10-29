<?php
include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("INSERT INTO users (username, email)");
    $stmt->execute([$username, $email]);

    header("Location: read_users.php");
}
?>
<form method="POST">
   Username: <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="email" required>
    <button type="submit">Simpan</button>
</form>
