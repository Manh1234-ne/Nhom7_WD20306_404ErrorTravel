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

        /* ITINERARY STYLES */
        .itinerary {
            margin-top: 12px;
        }

        .itinerary-day {
            border: 1px solid #e6edf0;
            border-radius: 8px;
            background: #fff;
            margin-bottom: 14px;
            overflow: hidden
        }

        .itinerary-day .day-header {
            padding: 12px 16px;
            background: #eef6fb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer
        }

        .itinerary-day .day-header h4 {
            margin: 0;
            font-size: 16px
        }

        .itinerary-day .day-header .toggle {
            font-size: 13px;
            color: #2563eb
        }

        .itinerary-day .day-slots {
            padding: 12px 16px
        }

        .itinerary-slot {
            display: flex;
            gap: 16px;
            padding: 10px 0;
            border-top: 1px dashed #e8eef2;
            align-items: center
        }

        .itinerary-slot:first-child {
            border-top: 0
        }

        .slot-time {
            width: 80px;
            color: #0f172a;
            font-weight: 600;
            flex-shrink: 0
        }

        .slot-content {
            flex: 1;
            min-width: 0
        }

        .slot-title {
            font-weight: 700;
            color: #475569
        }

        .slot-meta {
            color: #475569;

            margin-top: 8px
        }

        .slot-desc {
            margin-top: 8px;
            color: #334155
        }

        .slot-img {
            flex-shrink: 0
        }

        .slot-img img {
            max-width: 220px;
            height: auto;
            display: block;
            border-radius: 6px
        }

        .itinerary-day.collapsed .day-slots {
            display: none
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
        <!-- SECTION: THÔNG TIN CƠ BẢN -->
        <div class="section">
            <h2>Thông tin cơ bản</h2>
            <?php if (!empty($tour['hinh_anh'])): ?>
                <?php $mainImg = (defined('BASE_ASSETS_UPLOADS') ? BASE_ASSETS_UPLOADS : 'assets/uploads/') . $tour['hinh_anh']; ?>
                <div style="margin-bottom:12px;"><img src="<?= htmlspecialchars($mainImg) ?>" alt="Hình đại diện"
                        style="max-width:360px;display:block;margin-bottom:12px;border-radius:8px;border:1px solid #e2e8f0;">
                </div>
            <?php endif; ?>
            <?php if (!empty($album) && is_array($album)): ?>
                <div class="">
                    <h2>Ảnh Album</h2>
                    <div style="display:flex;flex-wrap:wrap;gap:10px;">
                        <?php foreach ($album as $a): ?>
                            <?php $src = (defined('BASE_ASSETS_UPLOADS') ? BASE_ASSETS_UPLOADS : 'assets/uploads/') . ($a->file_name ?? ''); ?>
                            <div><img src="<?= htmlspecialchars($src) ?>" alt="Album" class="album-img"
                                    style="width:140px;height:90px;object-fit:cover;"></div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <p><strong>Tên tour:</strong> <?= $tour["ten_tour"] ?></p>
            <p><strong>Mô tả:</strong> <?= nl2br($tour["mo_ta"]) ?></p>
            <p><strong>Chính sách:</strong> <?= nl2br($tour["chinh_sach"]) ?></p>
            <p><strong>Nhà cung cấp:</strong> <?= $tour["nha_cung_cap"] ?></p>
            <p><strong>Giá:</strong> <?= number_format($tour["gia"], 0, ',', '.') ?> VND</p>

            <?php
            $itinerary = [];
            if (!empty($tour['lich_trinh'])) {
                $decoded = json_decode($tour['lich_trinh'], true);
                if (is_array($decoded))
                    $itinerary = $decoded;
            }
            ?>

            <?php if (isset($_GET['dbg_assets']) && $_GET['dbg_assets'] == '1'): ?>
                <div class="section" style="background:#fff7ed;border:1px solid #ffedd5;">
                    <h2>Debug: assets & album</h2>
                    <pre style="white-space:pre-wrap;font-size:13px;color:#0f172a;">
                                                                    Main image (hinh_anh): <?= htmlspecialchars($tour['hinh_anh'] ?? 'NULL') ?>
                                                                    Main image URL: <?= htmlspecialchars((defined('BASE_ASSETS_UPLOADS') ? BASE_ASSETS_UPLOADS : 'assets/uploads/') . ($tour['hinh_anh'] ?? '')) ?>
                                                                    Main image FS: <?= htmlspecialchars(PATH_ASSETS_UPLOADS . ($tour['hinh_anh'] ?? '')) ?>
                                                                    Main image exists on disk: <?= file_exists(PATH_ASSETS_UPLOADS . ($tour['hinh_anh'] ?? '')) ? 'YES' : 'NO' ?>

                                                                    Album records (<?= is_array($album) ? count($album) : 0 ?>):
                                                                    <?php if (!empty($album) && is_array($album)): ?>
                                                                                                                                        <?php foreach ($album as $a): ?>
                                                                                                                                                                                                            - id: <?= htmlspecialchars($a->id) ?>
                                                                                                                                                                                                                file_name: <?= htmlspecialchars($a->file_name ?? '') ?>
                                                                                                                                                                                                                URL: <?= htmlspecialchars((defined('BASE_ASSETS_UPLOADS') ? BASE_ASSETS_UPLOADS : 'assets/uploads/') . ($a->file_name ?? '')) ?>
                                                                                                                                                                                                                FS: <?= htmlspecialchars(PATH_ASSETS_UPLOADS . ($a->file_name ?? '')) ?>
                                                                                                                                                                                                                exists: <?= file_exists(PATH_ASSETS_UPLOADS . ($a->file_name ?? '')) ? 'YES' : 'NO' ?>
                                                                                                                                        <?php endforeach; ?>
                                                                    <?php else: ?>
                                                                                                                                            (no album records)
                                                                    <?php endif; ?>
                                                                                                            </pre>
                </div>
            <?php endif; ?>

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
                                <?php if (!empty($day['slots']) && is_array($day['slots'])): ?>
                                    <?php foreach ($day['slots'] as $sIdx => $slot): ?>
                                        <div class="itinerary-slot">

                                            <div class="slot-time"><?= htmlspecialchars($slot['time'] ?? '') ?></div>

                                            <?php if (!empty($slot['image'])): ?>
                                                <?php $imgSrc = (defined('BASE_ASSETS_UPLOADS') ? BASE_ASSETS_UPLOADS : 'assets/uploads/') . $slot['image']; ?>
                                                <div class="slot-img">
                                                    <img src="<?= htmlspecialchars($imgSrc) ?>"
                                                        style="max-width:150px;border-radius:6px;border:1px solid #ddd;">
                                                </div>
                                            <?php endif; ?>

                                            <div class="slot-content">
                                                <div class="slot-title">
                                                    <?= htmlspecialchars($slot['title'] ?? ('Mốc ' . ($sIdx + 1))) ?>
                                                </div>
                                                <?php if (!empty($slot['location'])): ?>
                                                    <div class="slot-meta"><strong>Địa điểm:</strong>
                                                        <?= htmlspecialchars($slot['location']) ?></div>
                                                <?php endif; ?>
                                                <?php if (!empty($slot['desc'])): ?>
                                                    <div class="slot-desc"><strong>Mô tả:
                                                        </strong><?= nl2br(htmlspecialchars($slot['desc'])) ?></div>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div style="margin-top:6px;color:#6b7280;">Chưa có mốc nào cho ngày này.</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p><strong>Lịch trình:</strong> Chưa có lịch trình chi tiết.</p>
            <?php endif; ?>
        </div>



        <a href="?action=tours" class="btn btn-back"><i class="fa fa-arrow-left"></i> Quay lại</a>

        <a href="?action=dat_tour&id=<?= $tour['id'] ?>" class="btn btn-book">
            <i class="fa fa-check"></i> Đặt tour
        </a>
    </div>

</body>

</html>

<script>
    (function () {
        // toggle collapse for days
        document.querySelectorAll('.itinerary-day .day-header').forEach(function (h) {
            h.addEventListener('click', function () {
                const day = this.closest('.itinerary-day');
                if (day) day.classList.toggle('collapsed');
            });
        });
    })();
</script>