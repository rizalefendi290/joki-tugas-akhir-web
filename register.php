<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $query = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssss', $username, $email, $password, $role);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Registrasi berhasil. Silakan login.";
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['error'] = "Registrasi gagal. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pengguna</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #1a202c;
            color: white;
            font-family: 'Quicksand', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 400px;
            padding: 2rem;
            background-color: #2d3748;
            border-radius: 0.375rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.5);
        }
        h2 {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 1.5rem;
            color: #e53e3e;
        }
        .input-group {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            color: white;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 0.75rem;
            border-radius: 0.375rem;
            border: 1px solid #4a5568;
            background-color: #2d3748;
            color: white;
            box-sizing: border-box;
        }
        button[type="submit"] {
            width: 100%;
            padding: 0.75rem;
            border-radius: 0.375rem;
            background-color: #38c172;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }
        button[type="submit"]:hover {
            background-color: #2d995b;
        }
        p {
            text-align: center;
            margin-top: 1rem;
            color: #cbd5e0;
        }
        a {
            color: #38c172;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .error {
            background-color: #e53e3e;
            color: white;
            padding: 0.75rem;
            border-radius: 0.375rem;
            text-align: center;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registrasi Pengguna</h2>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error"><?php echo $_SESSION['error']; ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <form action="register.php" method="POST">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="role">Role</label>
                <select id="role" name="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit">Daftar</button>
        </form>
        <p>Sudah punya akun? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
