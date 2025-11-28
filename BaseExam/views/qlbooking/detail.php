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

        .sidebar i {
            margin-right: 10px;
        }

        .content {
            margin-left: 220px;
            padding: 30px;
        }

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.12);
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        /* left = album column, right = info column */
        .card .left {
            flex: 0 0 40%;
            max-width: 40%;
        }

        .card .right {
            flex: 1 1 60%;
        }

        .album-main {
            width: 100%;
            border-radius: 8px;
            display: block;
            margin-bottom: 12px;
        }

        .thumbs {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .album-img {
            border-radius: 8px;
            margin: 0;
            cursor: pointer;
            transition: 0.15s;
            width: 90px;
            height: 70px;
            object-fit: cover;
        }

        .album-img:hover {
            transform: scale(1.05);
        }

        .album-img.selected {
            /* outline: 3px solid #3498db; */
            transform: scale(1.05);
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

        /* responsive: stack on small screens */
        @media (max-width: 880px) {
            .card {
                flex-direction: column;
            }

            .card .left,
            .card .right {
                flex: 1 1 100%;
                max-width: 100%;
            }

            .album-img {
                width: 110px;
                height: 80px;
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
    </div>

    <div class="content">
        <h1>Chi tiết Booking</h1>

        <div class="card">

            <!-- RIGHT: booking info -->
            <div class="right">
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
                    <p><strong>Tình trạng thanh toán:</strong> <?= htmlspecialchars($qlb['tinh_trang_thanh_toan']) ?></p>
                    <p><strong>Yêu cầu đặc biệt:</strong> <?= htmlspecialchars($qlb['yeu_cau_dac_biet']) ?></p>

                    <a href="?action=qlbooking" class="btn-back">← Quay lại</a>
                </div>
            </div>


            <!-- LEFT: album -->
            <div class="left">

                <?php
                // ----- LOAD ALBUM NẾU CONTROLLER KHÔNG TRUYỀN -----
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

                // ----- XỬ LÝ ẢNH ĐẠI DIỆN -----
                $mainImgFilename = $mainImgFilename ?? "";

                if (empty($mainImgFilename) && !empty($album)) {
                    $first = is_object($album[0]) ? ($album[0]->file_name ?? "") : ($album[0]["file_name"] ?? "");
                    $mainImgFilename = $first;
                }

                $mainSrc = $mainImgFilename
                    ? (defined('BASE_ASSETS_UPLOADS') ? BASE_ASSETS_UPLOADS : 'assets/uploads/') . ltrim($mainImgFilename, '/')
                    : "";
                ?>

                <div class="album-block">
                    <h3>Ảnh Tour </h3>
                    <?php if ($mainSrc) : ?>
                        <img id="main-image" class="album-main" src="<?= htmlspecialchars($mainSrc) ?>?t=<?= time() ?>" alt="Ảnh đại diện">
                    <?php else : ?>
                        <img id="main-image" class="album-main" src="" alt="Chưa có ảnh đại diện" style="display:none;">
                        <p id="no-main-text">Chưa có ảnh đại diện.</p>
                    <?php endif; ?>
                </div>

                <div style="margin-top:12px;">
                    <h3>Album ảnh:</h3>

                    <?php if (!empty($album)) : ?>
                        <?php foreach ($album as $img) :
                            $filename = is_object($img) ? ($img->file_name ?? '') : ($img['file_name'] ?? '');
                            $src = (defined('BASE_ASSETS_UPLOADS') ? BASE_ASSETS_UPLOADS : 'assets/uploads/') . ltrim($filename, '/');
                            if ($filename):
                        ?>
                                <img class="album-img <?= $filename == $mainImgFilename ? 'selected' : '' ?>"
                                     data-filename="<?= htmlspecialchars($filename) ?>"
                                     src="<?= htmlspecialchars($src) ?>?t=<?= time() ?>"
                                     width="150"
                                     alt="">
                            <?php endif;
                        endforeach; ?>
                    <?php else : ?>
                        <p>Chưa có ảnh album.</p>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>

    <!-- JS chọn ảnh -->
    <script>
        (function() {
            const baseUploads = '<?= addslashes(defined('BASE_ASSETS_UPLOADS') ? BASE_ASSETS_UPLOADS : 'assets/uploads/') ?>';
            const mainImg = document.getElementById('main-image');

            document.querySelectorAll('.album-img').forEach(img => {
                img.addEventListener('click', function() {

                    const filename = this.getAttribute('data-filename');
                    if (!filename) return;

                    const src = baseUploads + filename;

                    // cập nhật ảnh đại diện
                    mainImg.src = src + "?t=" + Date.now();
                    mainImg.style.display = "block";

                    document.querySelectorAll(".album-img").forEach(i => i.classList.remove("selected"));
                    this.classList.add("selected");

                });
            });
        })();
    </script>

</body>

</html>
