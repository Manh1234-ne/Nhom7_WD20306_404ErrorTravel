<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chi tiết Tour</title>
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

        .card {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.12);
        }

        .album-img {
            border-radius: 8px;
            margin: 8px;
            transition: 0.2s;
        }

        .album-img:hover {
            transform: scale(1.1);
        }

        .btn-back {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 15px;
            background: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-back:hover {
            background: #2980b9;
        }

        img {
            border-radius: 6px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h2>Quản lý Tour</h2>
        <a href="?action=home"><i class="fa fa-home"></i>Trang chủ</a>
        <a href="?action=tours"><i class="fa fa-suitcase"></i>Quản lý tour</a>
        <a href="?action=nhansu"><i class="fa fa-user-tie"></i>Quản lý nhân sự</a>
        <a href="?action=danhmuc"><i class="nav-icon fas fa-th"></i>Quản lý danh mục</a>
    </div>

    <div class="content">
        <h1>Chi tiết Tour</h1>

        <div class="card">

            <h2><?= htmlspecialchars($tour['ten_tour']) ?></h2>

            <p><strong>Loại tour:</strong> <?= $tour['loai_tour'] ?></p>
            <p><strong>Mô tả:</strong> <?= nl2br($tour['mo_ta']) ?></p>
            <p><strong>Giá:</strong> <?= number_format($tour['gia']) ?> VNĐ</p>
            <p><strong>Chính sách:</strong> <?= nl2br($tour['chinh_sach']) ?></p>
            <p><strong>Nhà cung cấp:</strong> <?= $tour['nha_cung_cap'] ?></p>
            <p><strong>Mùa:</strong> <?= $tour['mua'] ?></p>

            <h3>Ảnh đại diện:</h3>
            <?php if (!empty($tour['hinh_anh'])): ?>
                <img src="assets/uploads/<?= $tour['hinh_anh'] ?>" width="350">
            <?php else: ?>
                <p>Chưa có ảnh đại diện.</p>
            <?php endif; ?>

            <h3>Album ảnh:</h3>
            <?php if (!empty($album)): ?>
                <?php foreach ($album as $img): ?>
                    <img class="album-img" src="assets/uploads/tour/album/<?= $img->file_name ?>" width="150">
                <?php endforeach; ?>
            <?php else: ?>
                <p>Chưa có ảnh album.</p>
            <?php endif; ?>

            <a href="?action=tours" class="btn-back">← Quay lại</a>
            <a href="?action=dat_tour&id=<?= $tour['id'] ?>" class="btn-back"
                style="background:#27ae60; margin-left:10px;">
                Đặt tour →
            </a>


        </div>
    </div>

</body>

</html>