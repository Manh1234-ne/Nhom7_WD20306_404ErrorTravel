<?php
if (session_status() == PHP_SESSION_NONE) session_start();
$errors_str = $errors_str ?? [];
$old = $old ?? [];
$flash = $_SESSION['flash_success'] ?? null;
if ($flash) unset($_SESSION['flash_success']);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập - 404 Error Travel</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f8;
        }

        /* NAV BAR */
        nav {
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 12px 40px;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #3b82f6;
        }

        .logo {
            font-size: 20px;
            font-weight: 800;
            color: #1e40af;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo::before {
            content: '✈️';
            font-size: 24px;
        }

        nav a {
            color: #3b82f6;
            font-weight: 700;
            text-decoration: none;
            font-size: 14px;
            padding: 8px 14px;
            border-radius: 6px;
            transition: 0.25s;
        }

        nav a:hover {
            background: #eff6ff;
        }

        /* LOGIN FORM */
        .container {
            margin-top: 140px;
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .login-box {
            background: #fff;
            width: 380px;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .login-box h1 {
            text-align: center;
            color: #1e293b;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: 600;
            color: #334155;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            transition: 0.25s;
        }

        input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px #bfdbfe;
        }

        button {
            margin-top: 22px;
            width: 100%;
            padding: 12px;
            font-size: 15px;
            font-weight: 700;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .error-box,
        .success-box {
            padding: 12px 14px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
            line-height: 1.5;
        }

        .error-box {
            background: #fee2e2;
            border-left: 4px solid #dc2626;
            color: #b91c1c;
        }

        .success-box {
            background: #d1fae5;
            border-left: 4px solid #059669;
            color: #065f46;
        }

        .error-box ul {
            margin-left: 20px;
        }
    </style>
</head>

<body>

    <nav>
        <a href="index.php?action=home"><strong>Home</strong></a>
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
                <label>Tên đăng nhập hoặc Email</label>
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