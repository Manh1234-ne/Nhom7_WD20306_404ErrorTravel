<?php
// Giả sử session đã được start ở index.php hoặc trước
$qlbooking = $qlbooking ?? []; // Dữ liệu booking
$edit_booking = $edit_booking ?? null; // Booking đang edit nếu có
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý Booking</title>
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

        .sidebar {
            width: 220px;
            background: #2c3e50;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            color: #fff;
            padding-top: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
        }

        .sidebar h2 {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #34495e;
            color: #38bdf8;
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

        h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
            color: #1e293b;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        th {
            background: #3b82f6;
            color: #fff;
            padding: 14px;
            text-align: left;
            font-weight: 600;
            font-size: 15px;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        tr:hover td {
            background: #f1f5f9;
        }

        a.btn {
            padding: 10px 16px;
            border-radius: 6px;
            color: #fff;
            text-decoration: none;
            margin-right: 6px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
            transition: 0.2s;
        }

        .btn-view {
            background: #0ea5e9;
        }

        .btn-view:hover {
            background: #0284c7;
        }

        .btn-edit {
            background: #f59e0b;
        }

        .btn-edit:hover {
            background: #d97706;
        }

        .btn-pay {
            background: #10b981;
        }

        .btn-pay:hover {
            background: #059669;
        }

        /* Form edit booking */
        .form-container {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 6px;
            font-weight: bold;
            color: #444;
        }

        input,
        textarea,
        select {
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 15px;
        }

        textarea {
            height: 42px;
        }

        .full {
            grid-column: span 2;
        }

        button {
            margin-top: 20px;
            padding: 12px 20px;
            background: #3498db;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #2980b9;
        }

        a.back-link {
            display: inline-block;
            margin-top: 12px;
            color: #3498db;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>404 Error Travel</h2>
        <a href="?action=home"><i class="fa fa-home"></i>Trang chủ</a>
        <a href="?action=tours"><i class="fa fa-suitcase"></i>Quản lý tour</a>
        <a href="?action=nhansu"><i class="fa fa-user-tie"></i>Quản lý nhân sự</a>
        <a href="?action=danhmuc"><i class="fa fa-th"></i>Quản lý danh mục</a>
        <a href="?action=qlbooking"><i class="fa fa-ticket"></i>Quản lý booking</a>
        <a href="?action=yeu_cau"><i class="fa fa-star"></i>Ghi chú đặc biệt</a>
    </div>

    <div class="content">
        <div class="top-bar">
            <h1>Quản lý Booking</h1>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên khách</th>
                    <th>Số điện thoại</th>
                    <th>Số người</th>
                    <th>Ngày khởi hành</th>
                    <th>Giá</th>
                    <th>HDV</th>
                    <th>Trạng thái</th>
                    <th>Tình trạng thanh toán</th>
                    <th>Yêu cầu đặc biệt</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($qlbooking)): ?>
                    <?php foreach ($qlbooking as $b): ?>
                        <tr>
                            <td><?= $b['id'] ?></td>
                            <td><?= htmlspecialchars($b['ten_khach']) ?></td>
                            <td><?= htmlspecialchars($b['so_dien_thoai']) ?></td>
                            <td><?= $b['so_nguoi'] ?></td>
                            <td><?= htmlspecialchars($b['ngay_khoi_hanh']) ?></td>
                            <td><?= number_format($b['gia'], 0, ',', '.') ?> VNĐ</td>
                             <td>
    <?php if (!empty($b['ten_hdv'])): ?>
        <?= htmlspecialchars($b['ten_hdv']) ?>
    <?php else: ?>
        <span style="color:#f97316;">Chưa phân công</span>
    <?php endif; ?>
</td>

                            <td><?= htmlspecialchars($b['trang_thai']) ?></td>
                            <td><?= htmlspecialchars($b['tinh_trang_thanh_toan']) ?></td>
                            <td><?= htmlspecialchars($b['yeu_cau_dac_biet']) ?></td>
                           
                                <a href="?action=qlbooking_detail&id=<?= $b['id'] ?>" class="btn btn-view"><i class="fa fa-eye"></i></a>
                                <a href="?action=qlbooking_edit&id=<?= $b['id'] ?>" class="btn btn-edit"><i class="fa fa-edit"></i></a>
                                <a href="?action=qlbooking_pay&id=<?= $b['id'] ?>" class="btn btn-pay"><i class="fa fa-credit-card"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" style="text-align:center; padding:20px;">Chưa có booking nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if ($edit_booking): ?>
            <div class="form-container">
                <h2>Sửa booking</h2>
                <form action="?action=qlbooking_edit_post" method="post">
                    <input type="hidden" name="id" value="<?= $edit_booking['id'] ?>">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Tên khách</label>
                            <textarea name="ten_khach"><?= htmlspecialchars($edit_booking['ten_khach']) ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <textarea name="so_dien_thoai"><?= htmlspecialchars($edit_booking['so_dien_thoai']) ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>CCCD</label>
                            <textarea name="cccd"><?= htmlspecialchars($edit_booking['cccd']) ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Số người</label>
                            <textarea name="so_nguoi"><?= htmlspecialchars($edit_booking['so_nguoi']) ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Ngày khởi hành</label>
                            <textarea name="ngay_khoi_hanh"><?= htmlspecialchars($edit_booking['ngay_khoi_hanh']) ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Giá</label>
                            <textarea name="gia"><?= htmlspecialchars($edit_booking['gia']) ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select name="trang_thai">
                                <?php
                                $statuses = ['Chưa xác nhận', 'Đã xác nhận', 'Đặt thành công', 'Đã hủy tour'];
                                foreach ($statuses as $status): ?>
                                    <option value="<?= $status ?>" <?= $edit_booking['trang_thai'] == $status ? 'selected' : '' ?>><?= $status ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tình trạng thanh toán</label>
                            <select name="tinh_trang_thanh_toan">
                                <?php
                                $types = ['Đã cọc', 'Chưa cọc', 'Chưa thanh toán', 'Đã thanh toán', 'Hủy bỏ'];
                                foreach ($types as $t): ?>
                                    <option value="<?= $t ?>" <?= $edit_booking['tinh_trang_thanh_toan'] == $t ? 'selected' : '' ?>><?= $t ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group full">
                            <label>Yêu cầu đặc biệt</label>
                            <select name="yeu_cau_dac_biet">
                                <?php
                                $specials = ['Ăn chay', 'Yêu cầu về dị ứng', 'Yêu cầu về bệnh lý', 'Yêu cầu về phòng nghỉ', 'Yêu cầu phương tiện di chuyển', 'Yêu cầu ăn uống', 'Khác'];
                                foreach ($specials as $s): ?>
                                    <option value="<?= $s ?>" <?= $edit_booking['yeu_cau_dac_biet'] == $s ? 'selected' : '' ?>><?= $s ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit">Cập nhật booking</button>
                    <a href="?action=qlbooking" class="back-link">Quay lại</a>
                </form>
            </div>
        <?php endif; ?>

    </div>
</body>

</html>