<?php
include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];

    $sql = "UPDATE users SET username = :username WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $username, 'id' => $id]);
    echo "User berhasil diperbarui!";
}
?>
<form method="POST">
    <input type="hidden" name="id" placeholder="User ID" required>
    <input type="text" name="username" placeholder="Username Baru" required>
    <button type="submit">Update User</button>
</form>
