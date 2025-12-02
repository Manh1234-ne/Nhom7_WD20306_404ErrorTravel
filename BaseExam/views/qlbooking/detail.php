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
    ],
    "16" => [
        [
            "ngay" => "Ngày 1",
            "gio" => "08:30",
            "hoat_dong" => "Tham quan Bán đảo Sơn Trà",
            "dia_diem" => "Sơn Trà, Đà Nẵng",
            "phuong_tien" => "Xe du lịch",
            "dich_vu" => "Vé tham quan",
            "mo_ta" => "Khám phá chùa Linh Ứng và ngắm toàn cảnh thành phố."
        ],
        [
            "ngay" => "Ngày 2",
            "gio" => "14:00",
            "hoat_dong" => "Khám phá Ngũ Hành Sơn",
            "dia_diem" => "Ngũ Hành Sơn, Đà Nẵng",
            "phuong_tien" => "Xe du lịch",
            "dich_vu" => "Vé tham quan",
            "mo_ta" => "Tham quan động Âm Phủ, làng đá mỹ nghệ Non Nước."
        ],
        [
            "ngay" => "Ngày 3",
            "gio" => "19:00",
            "hoat_dong" => "Xem cầu Rồng phun lửa – nước",
            "dia_diem" => "Cầu Rồng, Đà Nẵng",
            "phuong_tien" => "Đi bộ",
            "dich_vu" => "Không",
            "mo_ta" => "Thưởng thức show phun lửa – nước vào cuối tuần."
        ]
    ],


    "17" => [
        [
            "ngay" => "Ngày 1",
            "gio" => "08:30",
            "hoat_dong" => "Tham quan Dinh Độc Lập",
            "dia_diem" => "Quận 1, TP. HCM",
            "phuong_tien" => "Xe du lịch",
            "dich_vu" => "Vé tham quan",
            "mo_ta" => "Khám phá lịch sử Việt Nam qua các phòng trưng bày."
        ],
        [
            "ngay" => "Ngày 2",
            "gio" => "19:00",
            "hoat_dong" => "Dạo phố đi bộ Nguyễn Huệ",
            "dia_diem" => "Quận 1, TP. HCM",
            "phuong_tien" => "Đi bộ",
            "dich_vu" => "Không",
            "mo_ta" => "Ngắm cảnh, chụp hình và thưởng thức âm nhạc đường phố."
        ]
    ],

    "18" => [
        [
            "ngay" => "Ngày 1",
            "gio" => "08:30",
            "hoat_dong" => "Tham quan Buôn Đôn",
            "dia_diem" => "Buôn Đôn, Đắk Lắk",
            "phuong_tien" => "Xe du lịch",
            "dich_vu" => "Vé tham quan",
            "mo_ta" => "Khám phá nhà sàn cổ, cầu treo và văn hóa Ê Đê."
        ],
        [
            "ngay" => "Ngày 2",
            "gio" => "14:00",
            "hoat_dong" => "Tham quan Thác Dray Nur",
            "dia_diem" => "Đắk Lắk",
            "phuong_tien" => "Xe du lịch",
            "dich_vu" => "Vé tham quan",
            "mo_ta" => "Ngắm dòng thác hùng vĩ giữa núi rừng Tây Nguyên."
        ],
        [
            "ngay" => "Ngày 3",
            "gio" => "19:00",
            "hoat_dong" => "Thưởng thức cà phê Tây Nguyên",
            "dia_diem" => "Buôn Ma Thuột",
            "phuong_tien" => "Đi bộ",
            "dich_vu" => "Cà phê đặc sản",
            "mo_ta" => "Trải nghiệm hương vị cà phê nổi tiếng Việt Nam."
        ],
        [
            "ngay" => "Ngày 4",
            "gio" => "09:00",
            "hoat_dong" => "Khám phá Biển Hồ",
            "dia_diem" => "Pleiku, Gia Lai",
            "phuong_tien" => "Xe du lịch",
            "dich_vu" => "Không",
            "mo_ta" => "Ngắm thiên nhiên yên bình và chụp ảnh hồ nước trên núi."
        ]
    ]


];
?>2

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
          <div class="section">
            <h2>Lịch trình Tour</h2>
            <?php
            // Giả sử bạn đã có mảng $lich_trinh như mình demo trước đó
            // Ví dụ: $tour['id'] = 13 => lấy lịch trình của tour SaPa

            $tourId = $qlb['tour_id']; // hoặc slug như "sapa", "danang", "hue"

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