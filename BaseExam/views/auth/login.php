<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();
$errors_str = $errors_str ?? [];
$old = $old ?? [];
$flash = $_SESSION['flash_success'] ?? null;
if ($flash)
    unset($_SESSION['flash_success']);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        /* Thanh menu giống Home */
        nav {
            background: #3498db;
            color: #fff;
            padding: 15px 30px;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav .logo {
            font-size: 20px;
            font-weight: bold;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        /* Form đăng nhập */
        .container {
            margin-top: 120px;
            display: flex;
            justify-content: center;
        }

        .login-box {
            background: white;
            width: 380px;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
        }

        .login-box h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #444;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background: #3498db;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #2980b9;
        }

        .message {
            margin-top: 15px;
            text-align: center;
        }

        .message a {
            color: #3498db;
            font-weight: bold;
            text-decoration: none;
        }

        .message a:hover {
            text-decoration: underline;
        }

        .error-box ul {
            margin-left: 20px;
        }

        .error-box {
            background: #ffe6e6;
            border-left: 4px solid red;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            color: #b30000;
        }

        .success-box {
            background: #e6ffea;
            border-left: 4px solid #1abc9c;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            color: #117a65;
        }
    </style>

</head>

<body>

    <nav>
        <a href="index.php?action=home">Homee</a>
        <div class="logo">404 Error Travel</div>
    </nav>

    <div class="container">
        <div class="login-box">
            <h1>Đăng nhập</h1>

            <?php if ($flash): ?>
                <div class="success-box"><?= htmlspecialchars($flash) ?></div>
            <?php endif; ?>

            <?php if (!empty($errors_str)): ?>
                <div class="error-box">
                    <ul>
                        <?php foreach ($errors_str as $e): ?>
                            <li><?= htmlspecialchars($e) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" action="index.php?action=login">
                <label>Tên đăng nhập hoặc email</label>
                <input type="text" name="username_or_email"
                    value="<?= htmlspecialchars($old['username_or_email'] ?? '') ?>">

                <label>Mật khẩu</label>
                <input type="password" name="mat_khau">

                <button type="submit">Đăng nhập</button>
            </form>

            
        </div>
    </div>

</body>

</html>