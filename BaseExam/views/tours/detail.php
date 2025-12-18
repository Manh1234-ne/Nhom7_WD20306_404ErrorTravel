<?php
// ===============================
// LẤY THÔNG TIN TOUR
// ===============================
$gia = $tour['gia'] ?? 0;

// Lấy album tour
$album = $album ?? [];
if (empty($album)) {
    require_once PATH_MODEL . 'Tour.php';
    $tourModel = new Tour();
    $album = $tourModel->getAlbum($tour['id']);
}

// Ảnh chính
$mainImgFilename = '';
if (!empty($album)) {
    $first = is_object($album[0]) ? $album[0]->file_name : $album[0]['file_name'];
    $mainImgFilename = $first;
}

$baseUploads = 'assets/uploads/';
$mainSrc = $mainImgFilename ? $baseUploads . ltrim($mainImgFilename, '/') : '/assets/no-image.png';

// Lịch trình tour
$itinerary = [];
if (!empty($tour['lich_trinh'])) {
    $decoded = json_decode($tour['lich_trinh'], true);
    if (is_array($decoded)) $itinerary = $decoded;
}

// Hàm fix đường dẫn ảnh
function realImage($filename, $folder = 'tour')
{
    if (!$filename) return "/assets/no-image.png";

    $filename = ltrim($filename, '/');
    $serverPath = __DIR__ . "/../../assets/uploads/$folder/$filename";
    $webPath = "/assets/uploads/$folder/$filename";

    if (file_exists($serverPath)) return $webPath;
    return "/assets/no-image.png";
}

$avatarWeb = !empty($tour['hinh_anh']) ? realImage($tour['hinh_anh'], 'tour') : "/assets/no-image.png";
?>

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
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

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

        .content {
            margin-left: 250px;
            padding: 30px;
        }

        h1 {
            font-size: 28px;
            font-weight: 600;
            color: #1e293b;
            margin-top: 0;
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
            margin-right: 10px;
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

        .itinerary {
            margin-top: 12px;
        }

        .itinerary-day {
            border: 1px solid #e6edf0;
            border-radius: 8px;
            background: #fff;
            margin-bottom: 14px;
            overflow: hidden;
        }

        .day-header {
            padding: 12px 16px;
            background: #eef6fb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .day-header h4 {
            margin: 0;
            font-size: 16px;
        }

        .day-header .toggle {
            font-size: 13px;
            color: #2563eb;
        }

        .day-slots {
            padding: 12px 16px;
        }

        .itinerary-slot {
            display: flex;
            gap: 16px;
            padding: 10px 0;
            border-top: 1px dashed #e8eef2;
            align-items: center;
        }

        .itinerary-slot:first-child {
            border-top: 0;
        }

        .slot-time {
            width: 80px;
            color: #0f172a;
            font-weight: 600;
            flex-shrink: 0;
        }

        .slot-content {
            flex: 1;
            min-width: 0;
        }

        .slot-title {
            font-weight: 700;
            color: #475569;
        }

        .slot-meta {
            color: #475569;
            margin-top: 8px;
        }

        .slot-desc {
            margin-top: 8px;
            color: #334155;
        }

        .itinerary-day.collapsed .day-slots {
            display: none;
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
    </div>

    <div class="content">
        <h1>Chi tiết Tour: <?= htmlspecialchars($tour["ten_tour"]) ?></h1>

        <div class="card">
            <div class="left">
                <div class="info">
                    <p><strong>Tên tour:</strong> <?= htmlspecialchars($tour["ten_tour"]) ?></p>
                    <p><strong>Mô tả:</strong> <?= nl2br(htmlspecialchars($tour["mo_ta"])) ?></p>
                    <p><strong>Chính sách:</strong> <?= nl2br(htmlspecialchars($tour["chinh_sach"])) ?></p>
                    <p><strong>Nhà cung cấp:</strong> <?= htmlspecialchars($tour["nha_cung_cap"]) ?></p>
                    <p><strong>Giá:</strong> <?= number_format($gia) ?> VNĐ</p>
                </div>

                <!-- Lịch trình -->
                <?php if (!empty($itinerary)): ?>
                    <h3>Lịch trình chi tiết:</h3>
                    <div class="itinerary">
                        <?php foreach ($itinerary as $dayIdx => $day): ?>
                            <div class="itinerary-day" data-day="<?= $dayIdx ?>">
                                <div class="day-header">
                                    <h4><?= htmlspecialchars($day['title'] ?? ('Ngày ' . ($dayIdx + 1))) ?></h4>
                                    <div class="toggle">Ẩn/Hiện</div>
                                </div>
                                <div class="day-slots">
                                    <?php if (!empty($day['slots'])): ?>
                                        <?php foreach ($day['slots'] as $slot): ?>
                                            <div class="itinerary-slot">
                                                <div class="slot-time"><?= htmlspecialchars($slot['time'] ?? '') ?></div>
                                                <div class="slot-content">
                                                    <div class="slot-title"><?= htmlspecialchars($slot['title'] ?? '') ?></div>
                                                    <?php if (!empty($slot['location'])): ?>
                                                        <div class="slot-meta"><strong>Địa điểm:</strong> <?= htmlspecialchars($slot['location']) ?></div>
                                                    <?php endif; ?>
                                                    <?php if (!empty($slot['desc'])): ?>
                                                        <div class="slot-desc"><strong>Mô tả:</strong> <?= nl2br(htmlspecialchars($slot['desc'])) ?></div>
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

                <a href="?action=tours" class="btn">← Quay lại</a>
            <a href="?action=dat_tour&id=<?= $tour['id'] ?>" class="btn btn-book">Đặt tour →</a>

            </div>

            <div class="right">
                <h3>Ảnh Tour</h3>
                <img id="main-image" class="album-main" src="<?= htmlspecialchars($mainSrc) ?>" alt="Hình đại diện" style="max-width:220px; max-height:150px; margin-bottom:12px; object-fit:cover;">

                <h3>Album ảnh</h3>
                <div class="thumbs">
                    <?php foreach ($album as $img):
                        $fn = is_object($img) ? $img->file_name : $img['file_name'];
                        $src = $baseUploads . ltrim($fn, '/');
                    ?>
                        <img class="album-img" data-src="<?= htmlspecialchars($src) ?>" src="<?= htmlspecialchars($src) ?>">
                    <?php endforeach; ?>
                    
                </div>
                
            </div>
            
        </div>
        
    </div>

    <script>
        // Chọn ảnh album
        document.querySelectorAll('.album-img').forEach(img => {
            img.onclick = function() {
                document.getElementById('main-image').src = this.dataset.src;
                document.querySelectorAll('.album-img').forEach(i => i.classList.remove('selected'));
                this.classList.add('selected');
            }
        });

        // Ẩn/hiện lịch trình
        document.querySelectorAll('.itinerary-day .day-header').forEach(function(h) {
            h.addEventListener('click', function() {
                this.closest('.itinerary-day').classList.toggle('collapsed');
            });
        });
    </script>

</body>

</html>