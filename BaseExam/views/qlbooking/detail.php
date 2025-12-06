<?php
    $gia = $qlb['gia'];

    // Tính các khoản thanh toán
    $tien_coc = $gia * 0.4;
    $da_coc = $qlb['tien_coc_da_tra'] ?? 0;
    $da_full = $qlb['tien_full_da_tra'] ?? 0;

    $tong_da_tra = $da_coc + $da_full;

    // số tiền còn phải thanh toán tổng
    $con_thieu_full = $gia - $tong_da_tra;
    if ($con_thieu_full < 0) $con_thieu_full = 0;

    // Xác định trạng thái thanh toán
    if ($tong_da_tra == 0) {
        $txt_trang_thai = '<span style="color:red; font-weight:bold;">Chưa đóng đồng nào</span>';
    } elseif ($tong_da_tra < $gia) {
        $txt_trang_thai = '<span style="color:#f1c40f; font-weight:bold;">Đã thanh toán một phần</span>';
    } else {
        $txt_trang_thai = '<span style="color:green; font-weight:bold;">Đã thanh toán đầy đủ</span>';
    }
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chi tiết Tour</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { margin: 0; font-family: Arial, sans-serif; background: #f5f5f5; }
        .sidebar { width: 220px; background: #2c3e50; height: 100vh; position: fixed; top: 0; left: 0; color: #fff; display: flex; flex-direction: column; }
        .sidebar h2 { text-align: center; padding: 20px 0; border-bottom: 1px solid #34495e; }
        .sidebar a { padding: 15px 20px; color: #fff; text-decoration: none; display: flex; align-items: center; }
        .sidebar a:hover { background: #34495e; }
        .content { margin-left: 220px; padding: 30px; }
        .card { background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 3px 8px rgba(0,0,0,0.12); }
        .album-img { border-radius: 8px; margin: 8px; transition: 0.2s; }
        .album-img:hover { transform: scale(1.1); }
        .btn-back { margin-top: 20px; display: inline-block; padding: 10px 15px; background: #3498db; color: #fff; text-decoration: none; border-radius: 5px; }
        .btn-back:hover { background: #2980b9; }
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

        <p><strong>Tên khách:</strong> <?= $qlb['ten_khach'] ?></p>
        <p><strong>Số điện thoại:</strong> <?= $qlb['so_dien_thoai'] ?></p>
        <p><strong>Email:</strong> <?= $qlb['email'] ?></p>
        <p><strong>CCCD:</strong> <?= $qlb['cccd'] ?></p>
        <p><strong>Số người:</strong> <?= $qlb['so_nguoi'] ?></p>
        <p><strong>Ngày khởi hành:</strong> <?= $qlb['ngay_khoi_hanh'] ?></p>

        <h3>Album ảnh:</h3>
        <?php if (!empty($album)): ?>
            <?php foreach ($album as $img): ?>
                <img class="album-img" src="assets/uploads/tour/album/<?= $img->file_name ?>" width="150">
            <?php endforeach; ?>
        <?php else: ?>
            <p>Chưa có ảnh album.</p>
        <?php endif; ?>

        <p><strong>Giá tour:</strong> <?= number_format($gia) ?> VNĐ</p>

        <h3>Thông tin thanh toán</h3>

        <p><strong>Cọc 40%:</strong> <?= number_format($tien_coc) ?> VNĐ</p>
        <p><strong>Đã cọc:</strong> <?= number_format($da_coc) ?> VNĐ</p>
        <p><strong>Đã thanh toán FULL:</strong> <?= number_format($da_full) ?> VNĐ</p>

        <p><strong>Tổng đã thanh toán:</strong> <span style="color:#2980b9; font-weight:bold;"><?= number_format($tong_da_tra) ?> VNĐ</span></p>

        <p><strong>Còn phải thanh toán:</strong> 
            <span style="color:red; font-weight:bold;">
                <?= number_format($con_thieu_full) ?> VNĐ
            </span>
        </p>

        <p><strong>Tình trạng thanh toán:</strong> <?= $txt_trang_thai ?></p>

        <h3>Lịch sử thanh toán</h3>

        <?php if (empty($lich_su)): ?>
            <p>Chưa có lịch sử thanh toán.</p>
        <?php else: ?>
            <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 100%; margin-top: 10px;">
                <tr style="background: #eee;">
                    <th>Số tiền</th>
                    <th>Ngày thanh toán</th>
                </tr>

                <?php foreach ($lich_su as $ls): ?>
                <tr>
                    <td><?= number_format($ls['so_tien']) ?> VNĐ</td>
                    <td><?= $ls['ngay_thanh_toan'] ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <br>

        <?php if ($con_thieu_full > 0): ?>
            <a href="?action=qlbooking_pay&id=<?= $qlb['id'] ?>" 
               class="btn-back" 
               style="background:#27ae60;">+ Thanh toán thêm</a>
        <?php else: ?>
            <p style="color:green; font-weight:bold;">Đã thanh toán đủ — không thể thanh toán thêm.</p>
        <?php endif; ?>

        <br><br>

        <p><strong>Yêu cầu đặc biệt:</strong> <?= $qlb['yeu_cau_dac_biet'] ?></p>

        <a href="?action=qlbooking" class="btn-back">← Quay lại</a>

    </div>
</div>

</body>
</html>
