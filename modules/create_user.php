<?php
include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("INSERT INTO users (username, email,password) VALUES (:username, :email,:password)");
    $stmt->execute([':username' => $username, ':email' => $email,':password' => $password]);

    header("Location: read_users.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f0f4f8;
            font-family: Arial, sans-serif;
        }
        .form-container {
            background: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #333;
        }
        .form-control {
            border-radius: 5px;
            background: #f8f9fa;
            border: 1px solid #ced4da;
            margin-bottom: 1rem;
        }
        .form-control:focus {
            background: #e9ecef;
            box-shadow: none;
            border-color: #80bdff;
        }
        .btn-primary {
            background: #007bff;
            border: none;
            border-radius: 5px;
            width: 100%;
            padding: 0.5rem;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Create User</h2>
        <form method="POST">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <input type="email" class="form-control" name="email" placeholder="Email" required>
            <button type="submit" class="btn btn-primary">Create Account</button>
        </form>
    </div>
</body>
</html>
