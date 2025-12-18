<?php
// ===============================
// LẤY THÔNG TIN BOOKING
// ===============================
$gia = $qlb['gia'] ?? 0;

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
    require_once PATH_MODEL . 'Tour.php';
    $tourModel = new Tour();
    $album = $tourModel->getAlbum($qlb['tour_id']);
}

$mainImgFilename = '';
if (!empty($album)) {
    $first = is_object($album[0]) ? $album[0]->file_name : $album[0]['file_name'];
    $mainImgFilename = $first;
}

$baseUploads = 'assets/uploads/';
$mainSrc = $mainImgFilename ? $baseUploads . ltrim($mainImgFilename, '/') : '/assets/no-image.png';

// ===============================
// LẤY LỊCH TRÌNH
// ===============================
$itinerary = [];
if (!empty($tour['lich_trinh'])) {
    $decoded = json_decode($tour['lich_trinh'], true);
    if (is_array($decoded)) $itinerary = $decoded;
}

// ===============================
// HÀM FIX ĐƯỜNG DẪN ẢNH
// ===============================
function realImage($filename, $folder = 'tour')
{
    if (!$filename) return "/assets/no-image.png";

    $filename = ltrim($filename, '/');
    $serverPath = __DIR__ . "/../../assets/uploads/$folder/$filename";
    $webPath = "/assets/uploads/$folder/$filename";

    if (file_exists($serverPath)) return $webPath;

    return "/assets/no-image.png";
}

// ===============================
// LẤY DANH SÁCH HDV CHO FORM
// ===============================
require_once PATH_MODEL . 'NhanSu.php';
$nhanSuModel = new NhanSu();
$ds_hdv = $nhanSuModel->getAllHDVForAssign();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chi tiết Booking</title>
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
            margin-right: 10px;
            cursor: pointer;
            border: none;
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

        .slot-img img {
            max-width: 220px;
            height: auto;
            display: block;
            border-radius: 6px;
            border: 1px solid #ddd;
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

                <!-- Lịch trình tour -->
                <?php if (!empty($itinerary)): ?>
                    <h3>Lịch trình tour:</h3>
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

                <!-- Danh sách khách -->
                <?php
                if (!empty($qlb['danh_sach_file'])):
                    $filePath = PATH_ASSETS_UPLOADS . $qlb['danh_sach_file'];
                    if (file_exists($filePath)):
                ?>
                        <div style="margin-top:15px;">
                            <p style="background:#ecfeff;border-left:4px solid #06b6d4;padding:12px;border-radius:6px;">
                                <strong>Danh sách khách:</strong><br><br>
                                <a href="?action=download-booking-file&file=<?= urlencode($qlb['danh_sach_file']) ?>" class="btn" style="background:#16a34a">📄 Tải danh sách khách (Excel)</a>
                            </p>
                        </div>
                    <?php else: ?>
                        <div style="margin-top:15px;">
                            <p style="background:#fff7ed;border-left:4px solid #f97316;padding:12px;border-radius:6px;">
                                <strong>Danh sách khách:</strong><br>File đã lưu trong DB nhưng chưa có trên server.
                            </p>
                        </div>
                <?php endif;
                endif; ?>

                <!-- Phân công HDV -->
<hr>
<h3>Phân công Hướng dẫn viên</h3>

<?php if ($tong_da_tra < $tien_coc): ?>
    <p style="background:#fff7ed;border-left:4px solid #f97316;padding:12px;border-radius:6px;">
        Booking chưa đóng cọc → <strong>chưa thể phân công Hướng dẫn viên</strong>
    </p>

<?php else: ?>

    <?php if (!empty($phan_cong)): ?>
        <!-- ĐÃ PHÂN CÔNG -->
        <div style="background:#ecfeff;border-left:4px solid #06b6d4;padding:12px;border-radius:6px;">
            <p>
                <strong>HDV hiện tại:</strong> <?= htmlspecialchars($phan_cong['ten_hdv']) ?><br>
                <?php if (!empty($phan_cong['phuong_tien'])): ?>
                    <strong>Phương tiện:</strong> <?= htmlspecialchars($phan_cong['phuong_tien']) ?><br>
                <?php endif; ?>
                <?php if (!empty($phan_cong['ghi_chu'])): ?>
                    <strong>Ghi chú:</strong><br>
                    <?= nl2br(htmlspecialchars($phan_cong['ghi_chu'])) ?>
                <?php endif; ?>
            </p>

            <button
                type="button"
                class="btn"
                style="background:#f59e0b"
                onclick="document.getElementById('form-hdv').style.display='block'">
                🔄 Đổi HDV
            </button>
        </div>
    <?php endif; ?>

    <!-- FORM PHÂN CÔNG / ĐỔI HDV -->
    <form
        method="post"
        action="?action=<?= empty($phan_cong) ? 'qlbooking_phan_cong' : 'booking_doi_hdv' ?>"

        id="form-hdv"
        style="<?= !empty($phan_cong) ? 'display:none;' : '' ?>margin-top:15px;"
    >
        <input type="hidden" name="booking_id" value="<?= $qlb['id'] ?>">

        <div style="margin-bottom:10px;">
            <label><strong>Chọn Hướng dẫn viên:</strong></label><br>
            <select name="huong_dan_vien_id" required style="width:320px;padding:8px;">
                <option value="">-- Chọn HDV --</option>
                <?php foreach ($ds_hdv as $hdv): ?>
                    <option
                        value="<?= $hdv['hdv_id'] ?>"
                        <?= (!empty($phan_cong) && $phan_cong['huong_dan_vien_id'] == $hdv['hdv_id']) ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($hdv['ho_ten']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div style="margin-bottom:10px;">
            <label><strong>Ghi chú:</strong></label><br>
            <textarea
                name="ghi_chu"
                style="width:320px;padding:8px;"
                placeholder="Ghi chú phân công / đổi HDV"
            ><?= !empty($phan_cong['ghi_chu']) ? htmlspecialchars($phan_cong['ghi_chu']) : '' ?></textarea>
        </div>

        <button type="submit" class="btn" style="background:#16a34a">
            ✅ <?= empty($phan_cong) ? 'Phân công HDV' : 'Cập nhật HDV' ?>
        </button>
    </form>

<?php endif; ?>

                <!-- Nhật ký tour -->
                <hr>
                <h3>Nhật ký tour</h3>
                <?php if (!empty($nhat_ky)): ?>
                    <div>
                        <?php foreach ($nhat_ky as $log): ?>
                            <div style="margin-bottom:10px; padding:12px; border-left:4px solid 
                            <?php
                            switch ($log['loai_hanh_dong']) {
                                case 'Thanh toán cọc':
                                    echo '#facc15';
                                    break;
                                case 'Thanh toán full':
                                    echo '#16a34a';
                                    break;
                                case 'Phân công HDV':
                                    echo '#06b6d4';
                                    break;
                                case 'Tạo booking':
                                    echo '#2563eb';
                                    break;
                                case 'Yêu cầu đặc biệt':
                                    echo '#f97316';
                                    break;
                                default:
                                    echo '#9ca3af';
                            }
                            ?>; background:#f8f8f8; border-radius:6px;">
                                <strong>Loại hành động:</strong> <?= htmlspecialchars($log['loai_hanh_dong']) ?><br>
                                <strong>Ngày ghi:</strong> <?= htmlspecialchars($log['ngay_ghi']) ?><br>
                                <strong>Nội dung:</strong> <?= nl2br(htmlspecialchars($log['noi_dung'])) ?>
                                <?php if (!empty($log['huong_dan_vien_id'])): ?>
                                    <br><strong>HDV ID:</strong> <?= htmlspecialchars($log['huong_dan_vien_id']) ?>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p style="color:#6b7280;">Chưa có nhật ký nào.</p>
                <?php endif; ?>

                <br>
                <a href="?action=qlbooking" class="btn">← Quay lại</a>
            </div>

            <!-- RIGHT -->
            <div class="right">
                <h3>Ảnh Tour</h3>
                <?php if ($mainSrc): ?>
                    <img id="main-image" class="album-main" src="<?= htmlspecialchars($mainSrc) ?>" alt="Hình đại diện" style="max-width:220px; max-height:150px; margin-bottom:12px; border-radius:6px; object-fit:cover;">
                <?php else: ?>
                    <p>Chưa có ảnh.</p>
                <?php endif; ?>

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
        document.querySelectorAll('.itinerary-day .day-header').forEach(h => {
            h.addEventListener('click', function() {
                this.closest('.itinerary-day').classList.toggle('collapsed');
            });
        });
    </script>
</body>

</html>