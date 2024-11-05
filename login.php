<?php 
session_start();
include "config/koneksi.php";

if (isset($_POST['btn'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
  $stmt->execute(['username' => $username, 'password' => $password]);
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($result) {
    $_SESSION['iduser'] = $result['id'];
    $_SESSION['username'] = $result['username']; 

    header("Location: index.php");
    exit();
  } else {
    echo "<div class='error-message'>Gagal login. Username atau password salah.</div>";
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #0e0e0e;
            font-family: Arial, sans-serif;
        }
        .login-container {
            background: #1e1e1e;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.6);
            width: 100%;
            max-width: 400px;
            color: #f0f0f0;
        }
        .login-container h2 {
            color: #7dcef5;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .form-control {
            background: #333;
            border: none;
            color: #f0f0f0;
        }
        .form-control:focus {
            background: #444;
            box-shadow: none;
            border-color: #7dcef5;
        }
        .btn-primary {
            background: #7dcef5;
            border: none;
            width: 100%;
            margin-top: 1rem;
        }
        .btn-primary:hover {
            background: #67b5d6;
        }
        .error-message {
            color: #ff4d4d;
            text-align: center;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <button type="submit" name="btn" class="btn btn-primary mb-3">Login</button> 
            <a class="pt-3" href="modules/create_user.php">Buat Akun</a>
        </form>
    </div>
</body>
</html>
