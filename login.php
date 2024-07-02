<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role']; // Simpan role ke dalam sesi
            $_SESSION['message'] = "Selamat datang, " . $user['username'] . "!";

            if ($user['role'] === 'admin') {
                header('Location: dashboard.php'); // Redirect ke dashboard admin
            } else {
                header('Location: index.php'); // Redirect ke halaman index
            }
            exit;
        } else {
            $_SESSION['error'] = "Password salah. Silakan coba lagi.";
        }
    } else {
        $_SESSION['error'] = "Username tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pengguna</title>
    <link rel="stylesheet" href="styles.css">
	<style>
		/* styles.css */
body {
    background-color: #1a202c;
    color: white;
    font-family: 'Quicksand', sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    width: 90%;
    max-width: 600px;
    margin: 5% auto;
    padding: 2.5rem;
    background-color: #2d3748;
    border-radius: 0.5rem;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

h2 {
    text-align: center;
    margin-bottom: 2rem;
    color: #e53e3e;
}

form {
    display: flex;
    flex-direction: column;
}

.input-group {
    margin-bottom: 1rem;
}

label {
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
    color: #cbd5e0;
}

input[type="text"],
input[type="password"] {
    padding: 0.75rem;
    border: 1px solid #4a5568;
    border-radius: 0.375rem;
    background-color: #2d3748;
    color: white;
    font-size: 1rem;
    /* Ukuran yang sama untuk input */
    width: 100%;
    box-sizing: border-box; /* Untuk memastikan padding tidak menambah lebar input */
}

button[type="submit"] {
    padding: 0.75rem;
    border: none;
    border-radius: 0.375rem;
    background-color: #38c172;
    color: white;
    cursor: pointer;
    font-size: 1rem;
    /* Ukuran yang sama untuk button */
    width: 100%;
    box-sizing: border-box; /* Untuk memastikan padding tidak menambah lebar button */
    margin-top: 1rem; /* Margin tambahan untuk jarak antar elemen */
}

button[type="submit"]:hover {
    background-color: #2d995b;
}

.error {
    background-color: #c53030;
    color: white;
    text-align: center;
    padding: 0.75rem;
    border-radius: 0.375rem;
    margin-bottom: 1rem;
}

p {
    text-align: center;
    margin-top: 1rem;
}

a {
    color: #38c172;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

	</style>
</head>
<body>
    <div class="container">
        <h2>Login Pengguna</h2>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error"><?php echo $_SESSION['error']; ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <p>Belum punya akun? <a href="register.php">Daftar</a></p>
    </div>
</body>
</html>
