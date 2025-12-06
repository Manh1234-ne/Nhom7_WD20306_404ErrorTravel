<!-- views/yeu_cau/show.php -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
<<<<<<< HEAD
    <title>Chi tiết yêu cầu</title>
=======
    <title>Chi tiết Ghi chú</title>
>>>>>>> lebang271206-ui
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        .sidebar {
            width: 220px;
            background: #2c3e50;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            color: #fff;
            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #34495e;
        }

        .sidebar a {
            padding: 15px 20px;
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .sidebar a:hover {
            background: #34495e;
        }

        .sidebar i {
            margin-right: 10px;
        }

        .content {
            margin-left: 220px;
            padding: 30px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .details p {
            background: #fff;
            padding: 12px;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 10px;
        }

        a.btn {
            padding: 6px 12px;
            background: #3498db;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            margin-top: 10px;
        }

        a.btn i {
            margin-right: 5px;
        }

        a.btn:hover {
            background: #2980b9;
        }

        ul {
            background: #fff;
            padding: 15px;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        li {
            margin-bottom: 8px;
        }

        @media(max-width:768px) {
            .sidebar {
                width: 100%;
                height: auto;
                flex-direction: row;
                overflow-x: auto;
            }

            .sidebar h2 {
                display: none;
            }

            .sidebar a {
                flex: 1;
                justify-content: center;
            }

            .content {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>404 Error Travel</h2>
        <a href="?action=home"><i class="fa fa-home"></i>Trang chủ</a>
        <a href="?action=tours"><i class="fa fa-suitcase"></i>Quản lý tour</a>
        <a href="?action=nhansu"><i class="fa fa-user-tie"></i>Quản lý nhân sự</a>
<<<<<<< HEAD
        <a href="?action=yeu_cau"><i class="fa fa-star"></i>Yêu cầu đặc biệt</a>
=======
        <a href="?action=yeu_cau"><i class="fa fa-star"></i>Ghi chú đặc biệt</a>
>>>>>>> lebang271206-ui
    </div>

    <div class="content">
        <div class="top-bar">
<<<<<<< HEAD
            <h1>Chi tiết yêu cầu</h1>
=======
            <h1>Chi tiết Ghi chú</h1>
>>>>>>> lebang271206-ui
            <a href="index.php?action=yeu_cau" class="btn"><i class="fa fa-arrow-left"></i> Quay về</a>
        </div>

        <div class="details">
            <p><b>Tên khách:</b> <?= htmlspecialchars($yeuCau['ten_khach']) ?></p>
<<<<<<< HEAD
            <p><b>Loại yêu cầu:</b> <?= htmlspecialchars($yeuCau['loai_yeu_cau']) ?></p>
=======
            <p><b>Loại Ghi chú:</b> <?= htmlspecialchars($yeuCau['loai_yeu_cau']) ?></p>
>>>>>>> lebang271206-ui
            <p><b>Mô tả:</b> <?= nl2br(htmlspecialchars($yeuCau['mo_ta'])) ?></p>
            <p><b>Trạng thái:</b> <?= htmlspecialchars($yeuCau['trang_thai']) ?></p>

            <a href="index.php?action=yeu_cau_edit&id=<?= $yeuCau['id'] ?>" class="btn"><i class="fa fa-edit"></i> Chỉnh sửa / Ghi nhật ký</a>
        </div>

        <hr>

        <h3>Nhật ký xử lý</h3>
        <?php if(empty($logs)): ?>
            <p>Chưa có nhật ký xử lý.</p>
        <?php else: ?>
            <ul>
            <?php foreach($logs as $l): ?>
                <li><b><?= $l['created_at'] ?></b> — <?= htmlspecialchars($l['nguoi_xu_ly']) ?>: <?= nl2br(htmlspecialchars($l['ghi_chu'])) ?></li>
            <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>

</html>