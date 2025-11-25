<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Quản Lý Du Lịch</title>
    <style>
        /* Reset cơ bản */
        * { margin:0; padding:0; box-sizing:border-box; }

        body { font-family: Arial, sans-serif; background:#f5f5f5; }

        /* Thanh menu trên cùng */
        nav {
            background:#3498db;
            color:#fff;
            padding:15px 30px;
            position:fixed;
            width:100%;
            top:0;
            left:0;
            z-index:1000;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        nav .logo { font-size:20px; font-weight:bold; }
        nav ul { list-style:none; display:flex; }
        nav ul li { margin-left:20px; }
        nav ul li a { color:#fff; text-decoration:none; font-weight:bold; transition:0.3s; }
        nav ul li a:hover { text-decoration:underline; }

        /* Nội dung trang */
        .container {
            margin-top:80px; /* tránh menu che nội dung */
            padding:30px;
        }

        h1 { margin-bottom:20px; color:#333; }
        p { margin-bottom:15px; color:#555; }
        .card {
            background:#fff;
            padding:20px;
            border-radius:8px;
            margin-bottom:20px;
            box-shadow:0 2px 5px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<?php
if (session_status() == PHP_SESSION_NONE) session_start();
$user = $_SESSION['user'] ?? null;
?>
<nav>

    <!-- BÊN TRÁI: ĐĂNG NHẬP / XIN CHÀO -->
    <?php if ($user): ?>
        <span>
            Xin chào, <?=htmlspecialchars($user['ho_ten'] ?: $user['ten_dang_nhap'])?>
            <a href="index.php?action=logout" 
               onclick="return confirm('Đăng xuất tài khoản?')" 
               style="color: #fff; margin-left: 10px;">
                Đăng xuất
            </a>
        </span>
    <?php else: ?>
        <a href="index.php?action=loginForm" style="color:#fff;">Đăng nhập</a>
    <?php endif; ?>

    <!-- LOGO -->
    <div class="logo">404 Error Travel</div>

    <!-- MENU CHỨC NĂNG -->
    <ul>
        <li><a href="?action=/">Homee</a></li>

        <?php if (!$user): ?>
            <!-- Chưa đăng nhập → show alert + quay về Home -->
            <li>
                <a href="?action=/" onclick="alert('Bạn chưa đăng nhập!'); return true;">
                    Quản lý Tour
                </a>
            </li>
            <li>
                <a href="?action=/" onclick="alert('Bạn chưa đăng nhập!'); return true;">
                    Quản lý Nhân sự
                </a>
            </li>
            <li>
                <a href="?action=/" onclick="alert('Bạn chưa đăng nhập!'); return true;">
                    Quản lý Danh mục
                </a>
            </li>
            <li>
                <a href="?action=/" onclick="alert('Bạn chưa đăng nhập!'); return true;">
                    Quản lý Booking
                </a>
            </li>
            <li>
                <a href="?action=/" onclick="alert('Bạn chưa đăng nhập!'); return true;">
                    Yêu cầu đặc biệt
                </a>
            </li>
        <?php else: ?>
            <!-- Đã đăng nhập → vào trang thật -->
            <li><a href="?action=tours">Quản lý Tour</a></li>
            <li><a href="?action=nhansu">Quản lý Nhân sự</a></li>
            <li><a href="?action=danhmuc">Quản lý Danh mục</a></li>
            <li><a href="?action=qlbooking">Quản lý Booking</a></li>
            <li><a href="?action=yeu_cau">Ghi chú đặc biệt</a></li>
        <?php endif; ?>
    </ul>
</nav>

</body>
</html>
