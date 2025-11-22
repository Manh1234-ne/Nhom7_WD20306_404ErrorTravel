<?php
if (session_status() == PHP_SESSION_NONE) session_start();
$errors_str = $errors_str ?? [];
$old = $old ?? [];
$flash = $_SESSION['flash_success'] ?? null;
if ($flash) unset($_SESSION['flash_success']);
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Đăng nhập</title></head>
<body>
    <h1>Đăng nhập</h1>

    <?php if ($flash): ?>
        <div style="color:green"><?=htmlspecialchars($flash)?></div>
    <?php endif; ?>

    <?php if (!empty($errors_str)): ?>
        <div style="color:red">
            <ul><?php foreach($errors_str as $e): ?><li><?=htmlspecialchars($e)?></li><?php endforeach;?></ul>
        </div>
    <?php endif; ?>

    <form method="post" action="index.php?action=login">
        <label>Tên đăng nhập hoặc email<br><input type="text" name="username_or_email" value="<?=htmlspecialchars($old['username_or_email'] ?? '')?>"></label><br>
        <label>Mật khẩu<br><input type="password" name="mat_khau"></label><br>
        <button type="submit">Đăng nhập</button>
    </form>

    <p>Chưa có tài khoản? <a href="index.php?action=registerForm">Đăng ký</a></p>
</body>
</html>