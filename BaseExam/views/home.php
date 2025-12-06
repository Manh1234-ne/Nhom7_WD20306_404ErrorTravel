<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Tour Du Lịch</title>

    <style>
        body { box-sizing: border-box; }
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f8;
            min-height: 100%;
        }

        /* Navigation Bar */
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

        .nav-left { display: flex; align-items: center; gap: 15px; }
        .user-info { color: #334155; font-weight: 600; font-size: 14px; }

        .btn-auth {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 6px;
            background: #3b82f6;
            transition: 0.3s ease;
            font-size: 13px;
        }
        .btn-auth:hover {
            background: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .logo {
            font-size: 20px;
            font-weight: 800;
            color: #1e40af;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .logo::before { content: '✈️'; }

        .nav-menu { list-style: none; display: flex; gap: 6px; }
        .nav-menu li a {
            text-decoration: none;
            color: #475569;
            padding: 10px 16px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            transition: 0.3s ease;
        }
        .nav-menu li a:hover {
            background: #eff6ff;
            color: #3b82f6;
        }

        main {
            margin-top: 80px;
            padding: 30px;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
        }

        h1 { font-size: 32px; margin-bottom: 25px; color: #1e293b; }

        .welcome-card {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            padding: 40px;
            border-radius: 12px;
            color: #fff;
            margin-bottom: 30px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .feature-card {
            display: block; /* cho <a> cũng áp dụng được */
            text-decoration: none;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            transition: 0.3s;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            color: #1e293b;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            border-color: #3b82f6;
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
            color: #1e293b;
        }
        .feature-icon { font-size: 40px; margin-bottom: 15px; }
    </style>
</head>

<body>

<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$user = $_SESSION['user'] ?? null;
?>

<nav>
    <div class="nav-left">
        <?php if ($user): ?>
            <span class="user-info">
                Xin chào, <?= htmlspecialchars($user['ho_ten'] ?: $user['ten_dang_nhap']) ?>
            </span>

            <a href="index.php?action=logout"
               class="btn-auth"
               onclick="return confirm('Bạn có chắc muốn đăng xuất?')">
                Đăng xuất
            </a>
        <?php else: ?>
            <a href="index.php?action=loginForm" class="btn-auth">Đăng nhập</a>
        <?php endif; ?>
    </div>

   

    <ul class="nav-menu">
        <li><a href="?action=home">Home</a></li>



        <?php if (!$user): ?>

            <li><a href="#" onclick="alert('Bạn chưa đăng nhập!'); return false;">Quản lý Tour</a></li>
            <li><a href="#" onclick="alert('Bạn chưa đăng nhập!'); return false;">Nhân sự</a></li>
            <li><a href="#" onclick="alert('Bạn chưa đăng nhập!'); return false;">Danh mục</a></li>
            <li><a href="#" onclick="alert('Bạn chưa đăng nhập!'); return false;">Booking</a></li>
            <li><a href="#" onclick="alert('Bạn chưa đăng nhập!'); return false;">Ghi chú</a></li>
            <li><a href="#" onclick="alert('Bạn chưa đăng nhập!'); return false;">Chi tiết tour</a></li>


        <?php else: ?>

            <li><a href="?action=tours">Quản lý Tour</a></li>
            <li><a href="?action=nhansu">Nhân sự</a></li>
            <li><a href="?action=danhmuc">Danh mục</a></li>
            <li><a href="?action=qlbooking">Booking</a></li>
            <li><a href="?action=yeu_cau">Ghi chú</a></li>
            <li><a href="?action=tour_guest">Chi tiết tour</a></li>

        <?php endif; ?>
    </ul>
</nav>

<main>
    <h1>Hệ Thống Quản Lý Tour Du Lịch</h1>

    <div class="welcome-card">
        <h2>🌏 Chào mừng đến với 404 Error Travel</h2>
        <p>Hệ thống quản lý tour du lịch chuyên nghiệp giúp bạn quản lý dễ dàng và hiệu quả.</p>
    </div>

    <div class="features-grid">
        <a href="?action=tours" class="feature-card">
            <div class="feature-icon">🗺️</div>
            <h3>Quản lý Tour</h3>
            <p>Tạo, sửa, xem lịch trình – đầy đủ chức năng quản lý tour.</p>
        </a>

        <a href="?action=nhansu" class="feature-card">
            <div class="feature-icon">👥</div>
            <h3>Quản lý Nhân sự</h3>
            <p>Theo dõi nhân viên, hướng dẫn viên, phân công công việc.</p>
        </a>

        <a href="?action=danhmuc" class="feature-card">
            <div class="feature-icon">📋</div>
            <h3>Danh mục Tour</h3>
            <p>Phân loại và tổ chức tour theo danh mục, điểm đến.</p>
        </a>

        <a href="?action=qlbooking" class="feature-card">
            <div class="feature-icon">📅</div>
            <h3>Booking</h3>
            <p>Xử lý đặt chỗ, kiểm tra trạng thái, quản lý khách hàng.</p>
        </a>

        <a href="?action=yeu_cau" class="feature-card">
            <div class="feature-icon">📝</div>
            <h3>Ghi chú đặc biệt</h3>
            <p>Lưu các yêu cầu riêng của khách cho từng tour.</p>
        </a>

        <div class="feature-card">
            <div class="feature-icon">📊</div>
            <h3>Báo cáo & thống kê</h3>
            <p>Theo dõi doanh thu, thống kê hiệu suất công việc.</p>
        </div>

         <a href="?action=chi_tiet" class="feature-card">
            <div class="feature-icon">📑</div>
            <h3>Chi tiết Tour</h3>
            <p>Xem đầy đủ thông tin của từng khách trong tour.</p>
        </a>

    </div>
</main>

</body>
</html>
