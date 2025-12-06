<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chi tiết Tour</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #eef2f7;
        }

        /* SIDEBAR (THEO TOUR LIST) */
        .sidebar {
            width: 250px;
            background: #1e293b;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            color: #fff;
            padding-top: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
        }

        .sidebar h2 {
            font-size: 20px;
            text-align: center;
            margin-bottom: 25px;
            color: #38bdf8;
            font-weight: 600;
        }

        .sidebar a {
            padding: 14px 20px;
            color: #cbd5e1;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: 0.25s;
            font-size: 15px;
        }

        .sidebar a:hover {
            background: #334155;
            color: #fff;
        }

        .sidebar i {
            margin-right: 12px;
            font-size: 17px;
        }

        /* MAIN CONTENT */
        .content {
            margin-left: 250px;
            padding: 40px 35px;
        }

        h1 {
            font-size: 28px;
            font-weight: 600;
            color: #1e293b;
            margin-top: 0;
        }

        /* SECTION BOX */
        .section {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .section h2 {
            margin-top: 0;
            font-size: 22px;
            color: #1e293b;
        }

        .section p {
            font-size: 15px;
            color: #334155;
            margin: 8px 0;
        }

        img {
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        /* ALBUM */
        .album-img {
            border-radius: 8px;
            margin: 8px;
            transition: 0.25s;
            cursor: pointer;
            border: 1px solid #ddd;
        }

        .album-img:hover {
            transform: scale(1.06);
        }

        /* BUTTONS */
        .btn {
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 15px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: 0.2s;
            color: white;
        }

        .btn-back {
            background: #64748b;
        }

        .btn-back:hover {
            opacity: .85;
        }

        .btn-book {
            background: #10b981;
        }

        .btn-book:hover {
            opacity: .85;
        }
    </style>
</head>


<body>

    <div class="sidebar">
        <h2>404 Error Travel</h2>
        <a href="?action=home"><i class="fa fa-home"></i>Trang chủ</a>
        <a href="?action=tours"><i class="fa fa-suitcase"></i>Quản lý tour</a>
        <a href="?action=nhansu"><i class="fa fa-user-tie"></i>Quản lý nhân sự</a>
        <a href="?action=danhmuc"><i class="fa fa-th"></i>Danh mục tour</a>
        <a href="?action=qlbooking"><i class="fa fa-ticket"></i>Quản lý booking</a>
        <a href="?action=yeu_cau"><i class="fa fa-star"></i>Ghi chú đặc biệt</a>
        <a href="?action=tours"><i class="fa fa-list"></i> Chi tiết tour</a>

    </div>

    <div class="content">
        <h1>Chi tiết Tour: <?= htmlspecialchars($tour["ten_tour"]) ?></h1>

        <!-- SECTION: THÔNG TIN CƠ BẢN -->
        <div class="section">
            <h2>Thông tin cơ bản</h2>

            <p><strong>Tên tour:</strong> <?= $tour["ten_tour"] ?></p>
            <p><strong>Mô tả:</strong> <?= nl2br($tour["mo_ta"]) ?></p>
            <p><strong>Chính sách:</strong> <?= nl2br($tour["chinh_sach"]) ?></p>
            <p><strong>Nhà cung cấp:</strong> <?= $tour["nha_cung_cap"] ?></p>

            <h3>Ảnh đại diện:</h3>
            <?php if (!empty($tour["hinh_anh"])): ?>
                <img id="main-image"
                    src="<?= htmlspecialchars((defined('BASE_ASSETS_UPLOADS') ? BASE_ASSETS_UPLOADS : 'assets/uploads/') . $tour["hinh_anh"]) ?>"
                    width="350">
            <?php else: ?>
                <p>Chưa có ảnh đại diện.</p>
            <?php endif; ?>

            <h3>Album ảnh:</h3>
            <?php if (!empty($album)): ?>
                <?php foreach ($album as $img): ?>
                    <?php
                    $filename = is_object($img) ? ($img->file_name ?? '') : ($img['file_name'] ?? '');
                    $src = (defined('BASE_ASSETS_UPLOADS') ? BASE_ASSETS_UPLOADS : 'assets/uploads/') . $filename;
                    ?>
                    <img class="album-img" data-filename="<?= htmlspecialchars($filename) ?>"
                        src="<?= htmlspecialchars($src) ?>" width="150">
                <?php endforeach; ?>
            <?php else: ?>
                <p>Chưa có ảnh album.</p>
            <?php endif; ?>
        </div>

        <a href="?action=tours" class="btn btn-back"><i class="fa fa-arrow-left"></i> Quay lại</a>

        <a href="?action=dat_tour&id=<?= $tour['id'] ?>" class="btn btn-book">
            <i class="fa fa-check"></i> Đặt tour
        </a>
    </div>

</body>

</html>
