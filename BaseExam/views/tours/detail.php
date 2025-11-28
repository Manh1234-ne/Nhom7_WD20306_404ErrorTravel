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

        .section {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }

        .section h2,
        .section h3 {
            margin-top: 0;
        }

        .album-img {
            border-radius: 8px;
            margin: 8px;
            transition: 0.2s;
        }

        .album-img:hover {
            transform: scale(1.08);
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

        .box-highlight {
            background: #fff5eb;
            padding: 20px;
            border-radius: 10px;
        }

        img {
            border-radius: 6px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h2>404 Error Travel</h2>
        <a href="?action=home"><i class="fa fa-home"></i>Trang chủ</a>
        <a href="?action=tours"><i class="fa fa-suitcase"></i>Danh sách Tour</a>
        <a href="?action=nhansu"><i class="fa fa-user"></i>Quản lý nhân sự</a>
        <a href="?action=danhmuc"><i class="fa fa-list"></i>Danh Mục Tour</a>
        <a href="?action=qlbooking"><i class="fa fa-ticket"></i>Quản lý Booking</a>
        <a href="?action=yeucau"><i class="fa fa-star"></i>Ghi chú đặc biệt</a>
    </div>

    <div class="content">
        <h1>Chi tiết Tour: <?= htmlspecialchars($tour["ten_tour"]) ?></h1>

        <!-- THÔNG TIN CƠ BẢN -->
        <div class="section">
            <h2>Thông tin cơ bản</h2>

            <p><strong>Tên tour:</strong> <?= $tour["ten_tour"] ?></p>
            <p><strong>Mô tả:</strong> <?= nl2br($tour["mo_ta"]) ?></p>
            <p><strong>Chính sách:</strong> <?= nl2br($tour["chinh_sach"]) ?></p>
            <p><strong>Nhà cung cấp:</strong> <?= $tour["nha_cung_cap"] ?></p>

            <h3>Ảnh đại diện:</h3>
            <?php if (!empty($tour["hinh_anh"])): ?>
                <img id="main-image" src="<?= htmlspecialchars((defined('BASE_ASSETS_UPLOADS') ? BASE_ASSETS_UPLOADS : 'assets/uploads/') . $tour["hinh_anh"]) ?>" width="350" alt="Ảnh đại diện">
            <?php else: ?>
                <img id="main-image" src="" width="350" alt="Chưa có ảnh đại diện" style="display:none">
                <p id="no-main-text">Chưa có ảnh đại diện.</p>
            <?php endif; ?>

            <h3>Album ảnh:</h3>
            <?php if (!empty($album)): ?>
                <?php foreach ($album as $img): ?>
                    <?php
                    $filename = is_object($img) ? ($img->file_name ?? '') : ($img['file_name'] ?? '');
                    $src = (defined('BASE_ASSETS_UPLOADS') ? BASE_ASSETS_UPLOADS : 'assets/uploads/') . $filename;
                    ?>
                    <?php if (!empty($filename)): ?>
                        <img class="album-img" data-filename="<?= htmlspecialchars($filename) ?>" src="<?= htmlspecialchars($src) ?>" width="150" alt="">
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Chưa có ảnh album.</p>
            <?php endif; ?>
        </div>

        <!-- LỊCH TRÌNH -->
        <div class="section">
            <h2>Lịch trình</h2>
            <p><strong>Hoạt động:</strong> <?= $tour["lich_trinh_hoat_dong"] ?? "Chưa cập nhật" ?></p>
            <p><strong>Địa điểm:</strong> <?= $tour["dia_diem"] ?? "Chưa cập nhật" ?></p>
            <p><strong>Mô tả chi tiết:</strong>
                <?= isset($tour["mo_ta_lich_trinh"]) ? nl2br($tour["mo_ta_lich_trinh"]) : "Chưa cập nhật" ?>
            </p>
        </div>

        <!-- HƯỚNG DẪN VIÊN -->
        <div class="section">
            <h2>Hướng dẫn viên</h2>
            <p><strong>Tên:</strong> <?= $nhan_su["ho_ten"] ?? "Chưa có dữ liệu" ?></p>
            <p><strong>Ngôn ngữ:</strong> <?= $nhan_su["ngon_ngu"] ?? "Chưa có dữ liệu" ?></p>
            <p><strong>Chứng chỉ:</strong> <?= $nhan_su["chung_chi"] ?? "Chưa có dữ liệu" ?></p>
            <p><strong>Kinh nghiệm:</strong> <?= $nhan_su["kinh_nghiem"] ?? "0" ?> năm</p>
            <p><strong>Chuyên môn:</strong> <?= $nhan_su["chuyen_mon"] ?? "Không có" ?></p>
        </div>

        <a href="?action=tours" class="btn-back">← Quay lại danh sách</a>
        <a href="?action=dat_tour&id=<?= $tour['id'] ?>"
            class="btn-back"
            style="background:#27ae60; margin-left:10px;">
            Đặt tour →
        </a>
    </div>

    <!-- Script: click ảnh album -> thay ảnh đại diện và gửi AJAX cập nhật DB -->
    <script>
        (function() {
            const baseUploads = '<?= addslashes(defined('BASE_ASSETS_UPLOADS') ? BASE_ASSETS_UPLOADS : 'assets/uploads/') ?>';
            const tourId = <?= json_encode((int)($tour['id'] ?? 0)) ?>;
            const mainImg = document.getElementById('main-image');
            const noMainText = document.getElementById('no-main-text');

            document.querySelectorAll('.album-img').forEach(img => {
                img.style.cursor = 'pointer';
                img.addEventListener('click', function() {
                    const filename = this.getAttribute('data-filename');
                    if (!filename) return;

                    // cập nhật giao diện ngay
                    const newSrc = baseUploads + filename;
                    if (mainImg) {
                        mainImg.src = newSrc;
                        mainImg.style.display = '';
                        if (noMainText) noMainText.style.display = 'none';
                    }

                    // gửi yêu cầu AJAX để cập nhật hinh_anh trong DB
                    fetch('<?= htmlspecialchars(BASE_URL) ?>?action=set_main_image', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id: tourId,
                            filename: filename
                        })
                    }).then(r => r.json()).then(json => {
                        if (!json.success) {
                            console.error('Lỗi cập nhật ảnh đại diện:', json.message || json);
                        }
                    }).catch(err => console.error('AJAX error:', err));
                });
            });
        })();
    </script>

</body>

</html>