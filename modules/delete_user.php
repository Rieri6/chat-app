<?php
include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    echo "User berhasil dihapus!";
}
?>
<form method="POST">
    <input type="hidden" name="id" placeholder="User ID" required>
    <button type="submit">Delete User</button>
</form>
