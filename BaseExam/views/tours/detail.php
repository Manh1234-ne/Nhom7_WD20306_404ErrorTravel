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

        .timeline {
            position: relative;
            margin: 30px 0;
            padding-left: 40px;
            border-left: 3px solid #3498db;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 30px;
        }

        .timeline-item::before {
            content: "";
            position: absolute;
            left: -11px;
            top: 5px;
            width: 20px;
            height: 20px;
            background: #3498db;
            border-radius: 50%;
            border: 3px solid #fff;
        }

        .timeline-time {
            padding-left: 20px;
            font-weight: bold;
            color: #3498db;
            margin-bottom: 5px;
        }

        .timeline-content {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<?php
$lich_trinh = [
    // Tour SaPa
    "13" => [
        [
            "ngay" => "Ngày 1",
            "gio" => "08:00",
            "hoat_dong" => "Khởi hành từ Hà Nội",
            "dia_diem" => "Bến xe Mỹ Đình",
            "phuong_tien" => "Xe giường nằm",
            "dich_vu" => "Nước uống, wifi",
            "mo_ta" => "Tập trung, làm thủ tục, phát đồ ăn nhẹ."
        ],
        [
            "ngay" => "Ngày 1",
            "gio" => "13:00",
            "hoat_dong" => "Tham quan núi Hàm Rồng",
            "dia_diem" => "Sa Pa",
            "phuong_tien" => "Xe trung chuyển",
            "dich_vu" => "Vé tham quan, nước suối",
            "mo_ta" => "Khám phá vườn hoa, tham quan sân mây, thưởng thức đặc sản vùng cao."
        ],
        [
            "ngay" => "Ngày 2",
            "gio" => "09:00",
            "hoat_dong" => "Check-in bản Cát Cát",
            "dia_diem" => "Bản Cát Cát",
            "phuong_tien" => "Đi bộ",
            "dich_vu" => "Vé vào bản, hướng dẫn chụp ảnh",
            "mo_ta" => "Khám phá văn hóa người H’Mông, xem biểu diễn khèn, mua đồ thủ công mỹ nghệ."
        ]
    ],

    // Tour Đà Nẵng
    "14" => [
        [
            "ngay" => "Ngày 1",
            "gio" => "09:00",
            "hoat_dong" => "Bay từ Hà Nội đến Đà Nẵng",
            "dia_diem" => "Sân bay Nội Bài",
            "phuong_tien" => "Máy bay VietJet",
            "dich_vu" => "Xe đưa đón sân bay",
            "mo_ta" => "Làm thủ tục check-in, bay thẳng đến Đà Nẵng."
        ],
        [
            "ngay" => "Ngày 1",
            "gio" => "14:00",
            "hoat_dong" => "Tham quan Ngũ Hành Sơn",
            "dia_diem" => "Đà Nẵng",
            "phuong_tien" => "Xe du lịch",
            "dich_vu" => "Vé tham quan",
            "mo_ta" => "Leo núi, thăm động Âm Phủ, ngắm cảnh biển."
        ],
        [
            "ngay" => "Ngày 2",
            "gio" => "09:00",
            "hoat_dong" => "Khám phá phố cổ Hội An",
            "dia_diem" => "Hội An",
            "phuong_tien" => "Xe du lịch",
            "dich_vu" => "Vé tham quan phố cổ",
            "mo_ta" => "Thả đèn hoa đăng trên sông Hoài, dạo phố cổ."
        ],
        [
            "ngay" => "Ngày 3",
            "gio" => "10:00",
            "hoat_dong" => "Du thuyền trên sông Hàn",
            "dia_diem" => "Đà Nẵng",
            "phuong_tien" => "Du thuyền",
            "dich_vu" => "Buffet nhẹ trên tàu",
            "mo_ta" => "Ngắm cảnh thành phố về đêm trên sông Hàn."
        ]
    ],

    // Tour Huế
    "15" => [
        [
            "ngay" => "Ngày 1",
            "gio" => "08:30",
            "hoat_dong" => "Tham quan Đại Nội Huế",
            "dia_diem" => "Kinh thành Huế",
            "phuong_tien" => "Xe du lịch",
            "dich_vu" => "Vé tham quan",
            "mo_ta" => "Nghe thuyết minh về triều Nguyễn, tham quan cung điện."
        ],
        [
            "ngay" => "Ngày 1",
            "gio" => "14:00",
            "hoat_dong" => "Thăm lăng Khải Định",
            "dia_diem" => "Huế",
            "phuong_tien" => "Xe du lịch",
            "dich_vu" => "Vé tham quan",
            "mo_ta" => "Chụp ảnh kiến trúc pha trộn Đông – Tây."
        ],
        [
            "ngay" => "Ngày 2",
            "gio" => "19:00",
            "hoat_dong" => "Nghe ca Huế trên sông Hương",
            "dia_diem" => "Sông Hương",
            "phuong_tien" => "Thuyền rồng",
            "dich_vu" => "Trà sen, bánh Huế",
            "mo_ta" => "Thưởng thức ca Huế truyền thống trên thuyền."
        ]
    ]
];
?>

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
                <img id="main-image"
                    src="<?= htmlspecialchars((defined('BASE_ASSETS_UPLOADS') ? BASE_ASSETS_UPLOADS : 'assets/uploads/') . $tour["hinh_anh"]) ?>"
                    width="350" alt="Ảnh đại diện">
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
                        <img class="album-img" data-filename="<?= htmlspecialchars($filename) ?>"
                            src="<?= htmlspecialchars($src) ?>" width="150" alt="">
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Chưa có ảnh album.</p>
            <?php endif; ?>
        </div>

        <div class="section">
            <h2>Lịch trình Tour</h2>
            <?php
            // Giả sử bạn đã có mảng $lich_trinh như mình demo trước đó
// Ví dụ: $tour['id'] = 13 => lấy lịch trình của tour SaPa
            
            $tourId = $tour['id']; // hoặc slug như "sapa", "danang", "hue"
            
            // Kiểm tra xem tour có lịch trình không
            if (!empty($lich_trinh[$tourId])) {
                echo '<div class="timeline">';
                $currentDay = "";
                foreach ($lich_trinh[$tourId] as $item) {
                    // Nếu ngày thay đổi thì in ra header ngày
                    if ($item['ngay'] !== $currentDay) {
                        $currentDay = $item['ngay'];
                        echo "<div class='timeline-day'>{$item['ngay']}</div>";
                    }

                    // Render từng hoạt động
                    echo "
        <div class='timeline-item'>
            <div class='timeline-content'>
                <h3>{$item['gio']} - {$item['hoat_dong']}</h3>
                <p><strong>Địa điểm:</strong> {$item['dia_diem']}</p>
                <p><strong>Phương tiện:</strong> {$item['phuong_tien']}</p>
                <p><strong>Dịch vụ đi kèm:</strong> {$item['dich_vu']}</p>
                <p><strong>Mô tả:</strong> {$item['mo_ta']}</p>
            </div>
        </div>";
                }
                echo '</div>';
            } else {
                echo "<p>Chưa có lịch trình cho tour này.</p>";
            }
            ?>


        </div>

        <a href="?action=tours" class="btn-back">← Quay lại danh sách</a>
        <a href="?action=dat_tour&id=<?= $tour['id'] ?>" class="btn-back" style="background:#27ae60; margin-left:10px;">
            Đặt tour →
        </a>
    </div>

    <!-- Script: click ảnh album -> thay ảnh đại diện và gửi AJAX cập nhật DB -->
    <script>
        (function () {
            const baseUploads = '<?= addslashes(defined('BASE_ASSETS_UPLOADS') ? BASE_ASSETS_UPLOADS : 'assets/uploads/') ?>';
            const tourId = <?= json_encode((int) ($tour['id'] ?? 0)) ?>;
            const mainImg = document.getElementById('main-image');
            const noMainText = document.getElementById('no-main-text');

            document.querySelectorAll('.album-img').forEach(img => {
                img.style.cursor = 'pointer';
                img.addEventListener('click', function () {
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