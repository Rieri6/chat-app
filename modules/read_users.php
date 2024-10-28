<?php
include '../config/koneksi.php';

$sql = "SELECT * FROM users";
$stmt = $pdo->query($sql);

while ($row = $stmt->fetch()) {
    echo "Username: " . $row['username'] . "<br>";
}
?>
