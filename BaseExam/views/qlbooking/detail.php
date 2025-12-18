<?php
// ===============================
// TÍNH TOÁN THANH TOÁN
// ===============================
$gia = $qlb['gia'];

$tien_coc = $gia * 0.4;
$da_coc   = $qlb['tien_coc_da_tra'] ?? 0;
$da_full  = $qlb['tien_full_da_tra'] ?? 0;

$tong_da_tra = $da_coc + $da_full;
$con_thieu_full = $gia - $tong_da_tra;
if ($con_thieu_full < 0) $con_thieu_full = 0;

// Trạng thái thanh toán
if ($tong_da_tra == 0) {
    $txt_trang_thai = '<span style="color:red;font-weight:bold;">Chưa đóng đồng nào</span>';
} elseif ($tong_da_tra < $gia) {
    $txt_trang_thai = '<span style="color:#f1c40f;font-weight:bold;">Đã thanh toán một phần</span>';
} else {
    $txt_trang_thai = '<span style="color:green;font-weight:bold;">Đã thanh toán đầy đủ</span>';
}

// ===============================
// LẤY ALBUM TOUR
// ===============================
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
    }
}

$mainImgFilename = $mainImgFilename ?? '';
if (empty($mainImgFilename) && !empty($album)) {
    $first = is_object($album[0])
        ? ($album[0]->file_name ?? '')
        : ($album[0]['file_name'] ?? '');
    $mainImgFilename = $first;
}

$baseUploads = defined('BASE_ASSETS_UPLOADS')
    ? BASE_ASSETS_UPLOADS
    : 'assets/uploads/';

$mainSrc = $mainImgFilename ? $baseUploads . ltrim($mainImgFilename, '/') : '';
?>

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

        .content {
            padding: 30px;
        }

        .card {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, .12);
            display: flex;
            gap: 30px;
        }

        .left,
        .right {
            flex: 1;
        }

        .info p {
            margin: 8px 0;
            padding: 10px;
            background: #f8f8f8;
            border-radius: 6px;
            border-left: 4px solid #3498db;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            background: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            background: #2980b9;
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
        }

        .album-img.selected {
            border: 3px solid #3498db;
        }

        /* ===== LỊCH TRÌNH ===== */
        .itinerary {
            margin-top: 20px;
        }

        .itinerary-day {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
            overflow: hidden;
        }

        .day-header {
            background: #ecf0f1;
            padding: 12px 15px;
            font-weight: bold;
        }

        .day-slots {
            padding: 15px;
        }

        .itinerary-slot {
            display: flex;
            gap: 15px;
            border-top: 1px dashed #ddd;
            padding: 12px 0;
        }

        .itinerary-slot:first-child {
            border-top: none;
        }

        .slot-time {
            width: 80px;
            font-weight: bold;
            color: #2c3e50;
        }

        .slot-img img {
            max-width: 200px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .slot-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>

    <div class="content">
        <h1>Chi tiết Booking</h1>

        <div class="card">
            <!-- LEFT -->
            <div class="left">
                <div class="info">
                    <p><strong>Tên khách:</strong> <?= htmlspecialchars($qlb['ten_khach']) ?></p>
                    <p><strong>SĐT:</strong> <?= htmlspecialchars($qlb['so_dien_thoai']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($qlb['email']) ?></p>
                    <p><strong>CCCD:</strong> <?= htmlspecialchars($qlb['cccd']) ?></p>
                    <p><strong>Số người:</strong> <?= $qlb['so_nguoi'] ?></p>
                    <p><strong>Ngày khởi hành:</strong> <?= $qlb['ngay_khoi_hanh'] ?></p>
                    <p><strong>Giá tour:</strong> <?= number_format($gia) ?> VNĐ</p>
                    <p><strong>Cọc 40%:</strong> <?= number_format($tien_coc) ?> VNĐ</p>
                    <p><strong>Đã cọc:</strong> <?= number_format($da_coc) ?> VNĐ</p>
                    <p><strong>Đã thanh toán FULL:</strong> <?= number_format($da_full) ?> VNĐ</p>
                    <p><strong>Tổng đã thanh toán:</strong> <?= number_format($tong_da_tra) ?> VNĐ</p>
                    <p><strong>Còn phải thanh toán:</strong> <?= number_format($con_thieu_full) ?> VNĐ</p>
                    <p><strong>Tình trạng:</strong> <?= $txt_trang_thai ?></p>
                    <p><strong>Yêu cầu đặc biệt:</strong> <?= htmlspecialchars($qlb['yeu_cau_dac_biet']) ?></p>
                </div>

                <!-- ===============================
                     LỊCH TRÌNH TOUR ĐÃ ĐẶT
                =============================== -->
                <?php if (!empty($itinerary)): ?>
                    <div class="itinerary">
                        <h2>📍 Lịch trình tour đã đặt</h2>

                        <?php foreach ($itinerary as $dayIdx => $day): ?>
                            <div class="itinerary-day">
                                <div class="day-header">
                                    <?= htmlspecialchars($day['title'] ?? ('Ngày ' . ($dayIdx + 1))) ?>
                                </div>

                                <div class="day-slots">
                                    <?php if (!empty($day['slots'])): ?>
                                        <?php foreach ($day['slots'] as $slot): ?>
                                            <div class="itinerary-slot">
                                                <div class="slot-time">
                                                    <?= htmlspecialchars($slot['time'] ?? '') ?>
                                                </div>

                                                <?php if (!empty($slot['image'])): ?>
                                                    <div class="slot-img">
                                                        <img src="<?= htmlspecialchars($slot['image']) ?>">
                                                    </div>
                                                <?php endif; ?>

                                                <div>
                                                    <div class="slot-title">
                                                        <?= htmlspecialchars($slot['title'] ?? '') ?>
                                                    </div>

                                                    <?php if (!empty($slot['location'])): ?>
                                                        <div><strong>Địa điểm:</strong> <?= htmlspecialchars($slot['location']) ?></div>
                                                    <?php endif; ?>

                                                    <?php if (!empty($slot['desc'])): ?>
                                                        <div><strong>Mô tả:</strong><br>
                                                            <?= nl2br(htmlspecialchars($slot['desc'])) ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <br>
                <a href="?action=qlbooking" class="btn">← Quay lại</a>
            </div>

            <!-- RIGHT -->
            <div class="right">
                <h3>Ảnh Tour</h3>

                <?php if ($mainSrc): ?>
                    <img id="main-image" class="album-main" src="<?= htmlspecialchars($mainSrc) ?>">
                <?php else: ?>
                    <p>Chưa có ảnh.</p>
                <?php endif; ?>

                <h3>Album ảnh</h3>
                <div class="thumbs">
                    <?php foreach ($album as $img):
                        $fn = is_object($img) ? $img->file_name : $img['file_name'];
                        $src = $baseUploads . ltrim($fn, '/');
                    ?>
                        <img class="album-img <?= $fn == $mainImgFilename ? 'selected' : '' ?>"
                            data-src="<?= htmlspecialchars($src) ?>"
                            src="<?= htmlspecialchars($src) ?>">
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.album-img').forEach(img => {
            img.onclick = function() {
                document.getElementById('main-image').src = this.dataset.src;
                document.querySelectorAll('.album-img').forEach(i => i.classList.remove('selected'));
                this.classList.add('selected');
            }
        });
    </script>

</body>

</html>