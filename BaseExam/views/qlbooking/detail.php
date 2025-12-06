<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chi tiết Booking</title>
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

        .content {
            margin-left: 220px;
            padding: 30px;
        }

        .card {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.12);
            display: flex;
            gap: 30px;
        }

        /* LEFT: Thông tin */
        .left {
            flex: 1;
        }

        .info p {
            margin: 8px 0;
            padding: 10px;
            background: #f8f8f8;
            border-radius: 6px;
            border-left: 4px solid #3498db;
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

        /* RIGHT: Album */
        .right {
            flex: 1;
        }

        .album-main {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 12px;
        }

        .thumbs {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .album-img {
            width: 110px;
            height: 85px;
            object-fit: cover;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.15s;
        }

        .album-img:hover {
            transform: scale(1.05);
        }

        .album-img.selected {
            border: 3px solid #3498db;
        }

        @media (max-width: 900px) {
            .card {
                flex-direction: column;
            }
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
        <a href="?action=qlbooking"><i class="fa fa-suitcase"></i>Quản lý booking</a>
        <a href="?action=yeu_cau"><i class="fa fa-star"></i>Ghi chú đặc biệt</a>
        <a href="?action=tours"><i class="fa fa-list"></i> Chi tiết tour</a>

    </div>

    <div class="content">
        <h1>Chi tiết Booking</h1>

        <div class="card">

            <!-- LEFT: THÔNG TIN -->
            <div class="left">
                <div class="info">
                    <p><strong>Tên khách:</strong> <?= htmlspecialchars($qlb['ten_khach']) ?></p>
                    <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($qlb['so_dien_thoai']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($qlb['email']) ?></p>
                    <p><strong>CCCD:</strong> <?= htmlspecialchars($qlb['cccd']) ?></p>
                    <p><strong>Số người:</strong> <?= htmlspecialchars($qlb['so_nguoi']) ?></p>
                    <p><strong>Ngày khởi hành:</strong> <?= htmlspecialchars($qlb['ngay_khoi_hanh']) ?></p>
                    <p><strong>Giá:</strong> <?= number_format($qlb['gia']) ?> VNĐ</p>
                    <p><strong>Tiền cọc:</strong> <?= number_format($qlb['tien_coc']) ?> VNĐ</p>
                    <p><strong>Trạng thái:</strong> <?= htmlspecialchars($qlb['trang_thai']) ?></p>
                    <p><strong>Thanh toán:</strong> <?= htmlspecialchars($qlb['tinh_trang_thanh_toan']) ?></p>
                    <p><strong>Yêu cầu đặc biệt:</strong> <?= htmlspecialchars($qlb['yeu_cau_dac_biet']) ?></p>
                </div>

                <a href="?action=qlbooking" class="btn-back">← Quay lại</a>
            </div>

            <!-- RIGHT: ALBUM -->
            <div class="right">

                <?php
                if (empty($album)) {
                    if (defined('PATH_MODEL') && file_exists(PATH_MODEL . 'Tour.php')) {
                        require_once PATH_MODEL . 'Tour.php';
                        try {
                            $tourModel = new Tour();
                            $tourId = $qlb['tour_id'] ?? null;
                            $album = $tourId ? $tourModel->getAlbum($tourId) : [];
                        } catch (Throwable $e) {
                            $album = [];
                        }
                    } else {
                        $album = [];
                    }
                }

                $mainImgFilename = $mainImgFilename ?? "";

                if (empty($mainImgFilename) && !empty($album)) {
                    $first = is_object($album[0]) ? ($album[0]->file_name ?? "") : ($album[0]["file_name"] ?? "");
                    $mainImgFilename = $first;
                }

                $mainSrc = $mainImgFilename
                    ? (defined('BASE_ASSETS_UPLOADS') ? BASE_ASSETS_UPLOADS : 'assets/uploads/') . ltrim($mainImgFilename, '/')
                    : "";
                ?>

                <h3>Ảnh Tour</h3>

                <?php if ($mainSrc): ?>
                    <img id="main-image" class="album-main" src="<?= htmlspecialchars($mainSrc) ?>?t=<?= time() ?>">
                <?php else: ?>
                    <p>Chưa có ảnh đại diện.</p>
                <?php endif; ?>

                <h3>Album ảnh</h3>
                <div class="thumbs">

                    <?php if (!empty($album)): ?>
                        <?php foreach ($album as $img):
                            $filename = is_object($img) ? ($img->file_name ?? '') : ($img['file_name'] ?? '');
                            $src = (defined('BASE_ASSETS_UPLOADS') ? BASE_ASSETS_UPLOADS : 'assets/uploads/') . ltrim($filename, '/');
                        ?>
                            <img class="album-img <?= $filename == $mainImgFilename ? 'selected' : '' ?>"
                                data-filename="<?= htmlspecialchars($filename) ?>"
                                src="<?= htmlspecialchars($src) ?>?t=<?= time() ?>">
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Không có ảnh album.</p>
                    <?php endif; ?>

                </div>

            </div>
        </div>
    </div>

    <!-- JS đổi ảnh -->
    <script>
        (function () {
            const baseUploads = '<?= addslashes(defined('BASE_ASSETS_UPLOADS') ? BASE_ASSETS_UPLOADS : 'assets/uploads/') ?>';
            const mainImg = document.getElementById('main-image');

            document.querySelectorAll('.album-img').forEach(img => {
                img.addEventListener('click', function () {
                    const filename = this.dataset.filename;
                    if (!filename) return;

                    mainImg.src = baseUploads + filename + "?t=" + Date.now();

                    document.querySelectorAll(".album-img").forEach(i => i.classList.remove("selected"));
                    this.classList.add("selected");
                });
            });
        })();
    </script>

</body>
</html>
