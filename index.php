<?php
session_start();

// Jika sudah login, langsung ke dashboard
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

// ✅ Proses Login (diletakkan sebelum HTML)
if (isset($_POST['login'])) {
    $user = "admin";
    $pass = "1234";

    $input_user = $_POST['username'];
    $input_pass = $_POST['password'];

    if ($input_user == $user && $input_pass == $pass) {
        $_SESSION['username'] = $input_user;
        header("Location: dashboard.php");
        exit();
    } else {
        header("Location: index.php?error=Username atau Password salah");
        exit();
    }
}

// Cek jika ada pesan error
$error = isset($_GET['error']) ? $_GET['error'] : "";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #EBEFF3FF, #EBEEF1FF);
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            width: 320px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #007bff;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #0056b3;
        }

        .error {
            color: red;
            margin-bottom: 15px;
            font-size: 14px;
        }

        footer {
            position: absolute;
            bottom: 15px;
            font-size: 13px;
            color: #fff;
            text-align: center;
            width: 100%;
        }
        .cancel-btn {
    width: 100%;
    padding: 10px;
    background: #FCFDFDFF;
    border: none;
    color: white;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
    margin-top: 8px;
}

.cancel-btn:hover {
    background: #5a6268;
}
.footer-text {
    color: rgba(0, 0, 0, 0.5); /* warna abu pudar */
    font-size: 12px;           /* sedikit lebih kecil */
    margin-top: 15px;
}

    </style>
</head>
<body>

<div class="login-box">
    <h2>POLGAN MART</h2>

    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
        <button type="button" class="cancel-btn" onclick="window.location.href='index.php'">Batal</button>

    </form>
    <p class="footer-text">© 2025 POLGAN MART</p>
</div>

<footer>© 2025 POLGAN MART</footer>

</body>
</html>
