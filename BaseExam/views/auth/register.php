<!-- <?php
if (session_status() == PHP_SESSION_NONE) session_start();
$errors_str = $errors_str ?? [];
$old = $old ?? [];
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Đăng ký</title></head>
<body>
    <h1>Đăng ký</h1>

    <?php if (!empty($errors_str)): ?>
        <div style="color:red">
            <ul><?php foreach($errors_str as $e): ?><li><?=htmlspecialchars($e)?></li><?php endforeach;?></ul>
        </div>
    <?php endif; ?>

    <form method="post" action="index.php?action=register">
        <label>Họ tên<br><input type="text" name="ho_ten" value="<?=htmlspecialchars($old['ho_ten'] ?? '')?>"></label><br>
        <label>Tên đăng nhập<br><input type="text" name="ten_dang_nhap" value="<?=htmlspecialchars($old['ten_dang_nhap'] ?? '')?>"></label><br>
        <label>Email<br><input type="email" name="email" value="<?=htmlspecialchars($old['email'] ?? '')?>"></label><br>
        <label>Số điện thoại<br><input type="text" name="so_dien_thoai" value="<?=htmlspecialchars($old['so_dien_thoai'] ?? '')?>"></label><br>
        <label>Mật khẩu<br><input type="password" name="mat_khau"></label><br>
        <label>Nhập lại mật khẩu<br><input type="password" name="mat_khau_confirm"></label><br>
        <button type="submit">Đăng ký</button>
    </form>

    <p>Đã có tài khoản? <a href="index.php?action=loginForm">Đăng nhập</a></p>
</body>
</html> -->
