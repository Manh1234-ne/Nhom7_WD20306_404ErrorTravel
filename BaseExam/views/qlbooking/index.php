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
            width: 250px;
            background: #1e293b;
    <title>Danh sách Tour</title>
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
            padding: 40px 35px;
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

        .btn-add {
            background: #3b82f6;
            padding: 10px 16px;
            border-radius: 6px;
            color: #fff;
            text-decoration: none;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: 0.2s;
        }

        .btn-add:hover {
            background: #2563eb;
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

        .btn-delete {
            background: #ef4444;
        }

        .btn-delete:hover {
            background: #b91c1c;
        }

<<<<<<< HEAD
=======

            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #3498db;
            color: #fff;
        }

        a.btn {
            padding: 6px 12px;
            background: #3498db;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
            margin-right: 5px;
        }

        a.btn:hover {
            background: #2980b9;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

>>>>>>> 75f56cf82ca89db6fc4daec0ea1c3efaf034d277
        @media(max-width:768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                flex-direction: row;
                overflow-x: auto;
            }

            .sidebar h2 {
                display: none;
            }

            .sidebar a {
                flex: 1;
                justify-content: center;
            }

            .content {
                margin-left: 0;
                padding: 20px;
            }
        }

        /* CSS thêm cho album ảnh và thanh toán */
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
            border: 3px solid #3b82f6;
        }

        .payment-info p {
            margin: 8px 0;
            padding: 8px 10px;
            background: #f3f4f6;
            border-left: 4px solid #3b82f6;
            border-radius: 4px;
        }

        /* CSS form sửa booking */
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

<<<<<<< HEAD
        <!-- Bảng quản lý booking -->
=======
        <h2>Quản lý Tour</h2>
        <a href="?action=home"><i class="fa fa-home"></i>Trang chủ</a>
        <a href="?action=tours"><i class="fa fa-suitcase"></i>Quản lý tourr</a>
        <a href="?action=nhansu"><i class="fa fa-user-tie"></i>Quản lý nhân sự</a>
        <a href="?action=danhmuc"><i class="nav-icon fas fa-th"></i>Quản lý danh mục</a>
        <a href="?action=qlbooking"><i class="fa fa-suitcase"></i>Quản lý booking</a>
        <a href="?action=yeu_cau"><i class="fa fa-star"></i>Ghi chú đặc biệt</a>

    </div>
    <div class="content">
>>>>>>> 75f56cf82ca89db6fc4daec0ea1c3efaf034d277
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên khách</th>
                    <th>SĐT</th>
                    <th>Số người</th>
                    <th>Số điện thoại</th>
                    <th>Số người</th>
                    <th>Ngày khởi hành</th>
                    <th>Giá</th>
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
                            <td><?= $b['so_dien_thoai'] ?></td>
                            <td><?= $b['so_nguoi'] ?></td>
                            <td><?= number_format($b['gia'], 0, ',', '.') ?> VNĐ</td>
                            <td><?= $b['trang_thai'] ?></td>
                            <td><?= $b['tinh_trang_thanh_toan'] ?></td>
                            <td><?= htmlspecialchars($b['yeu_cau_dac_biet']) ?></td>
                            <td>
                                <a href="?action=qlbooking_detail&id=<?= $b['id'] ?>" class="btn btn-view"><i class="fa fa-eye"></i></a>
                                <a href="?action=qlbooking_edit&id=<?= $b['id'] ?>" class="btn btn-edit"><i class="fa fa-edit"></i></a>
                                <a href="?action=qlbooking_pay&id=<?= $b['id'] ?>" class="btn btn-add"><i class="fa fa-credit-card"></i>Thanh toán</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9">
                                <?php
                                $gia = $b['gia'];
                                $tien_coc = $gia * 0.4;
                                $da_coc = $b['tien_coc_da_tra'] ?? 0;
                                $da_full = $b['tien_full_da_tra'] ?? 0;
                                $tong_da_tra = $da_coc + $da_full;
                                $con_thieu_full = max(0, $gia - $tong_da_tra);
                                if ($tong_da_tra == 0) {
                                    $txt_trang_thai = '<span style="color:red; font-weight:bold;">Chưa đóng đồng nào</span>';
                                } elseif ($tong_da_tra < $gia) {
                                    $txt_trang_thai = '<span style="color:#f1c40f; font-weight:bold;">Đã thanh toán một phần</span>';
                                } else {
                                    $txt_trang_thai = '<span style="color:green; font-weight:bold;">Đã thanh toán đầy đủ</span>';
                                }
                                ?>
                                <div class="payment-info">
                                    <p><strong>Tiền cọc 40%:</strong> <?= number_format($tien_coc) ?> VNĐ</p>
                                    <p><strong>Đã cọc:</strong> <?= number_format($da_coc) ?> VNĐ</p>
                                    <p><strong>Đã thanh toán FULL:</strong> <?= number_format($da_full) ?> VNĐ</p>
                                    <p><strong>Tổng đã thanh toán:</strong> <?= number_format($tong_da_tra) ?> VNĐ</p>
                                    <p><strong>Còn phải thanh toán:</strong> <?= number_format($con_thieu_full) ?> VNĐ</p>
                                    <p><strong>Tình trạng thanh toán:</strong> <?= $txt_trang_thai ?></p>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" style="text-align:center; padding:20px;">Chưa có booking nào.</td>
                    </tr>
                <?php endif; ?>
                <?php foreach ($qlbooking as $qlb): ?>
                    <tr>
                       <td><?= $qlb['id'] ?></td>
                            <td><?= htmlspecialchars($qlb['ten_khach']) ?></td>
                            <td><?= $qlb['so_dien_thoai'] ?></td>
                            <td><?= $qlb['so_nguoi'] ?></td>
                            <td><?= $qlb['ngay_khoi_hanh'] ?></td>
                            <td><?= number_format($qlb['gia'], 0, ',', '.') ?> VNĐ</td>
                            <td><?= $qlb['trang_thai'] ?></td>
                            <td><?= $qlb['tinh_trang_thanh_toan'] ?></td>
                            <td><?= $qlb['yeu_cau_dac_biet'] ?></td>
                            <td>
                               <a href="?action=qlbooking_detail&id=<?= $qlb['id'] ?>" class="btn">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="?action=qlbooking_edit&id=<?= $qlb['id'] ?>" class="btn"><i class="fa fa-edit"></i></a>
                            <a href="?action=qlbooking_pay&id=<?= $qlb['id'] ?>" class="btn btn-success btn-sm">  <i class="fa fa-credit-card"></i>
</a>
                </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Form sửa booking -->
        <?php if (isset($edit_booking) && $edit_booking): ?>
            <div class="form-container">
                <h2>Sửa booking</h2>
                <form action="?action=qlbooking_edit_post" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $qlb['id'] ?>">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Tên khách</label>
                            <textarea name="ten_khach"><?= $qlb['ten_khach'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <textarea name="so_dien_thoai"><?= $qlb['so_dien_thoai'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>CCCD</label>
                            <textarea name="cccd"><?= $qlb['cccd'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Số người</label>
                            <textarea name="so_nguoi"><?= $qlb['so_nguoi'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Ngày khởi hành</label>
                            <textarea name="ngay_khoi_hanh"><?= $qlb['ngay_khoi_hanh'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Giá</label>
                            <textarea name="gia"><?= $qlb['gia'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select name="trang_thai">
                                <?php
                                $statuses = ['Chưa xác nhận', 'Đã xác nhận', 'Đặt thành công', 'Đã hủy tour'];
                                foreach ($statuses as $status): ?>
                                    <option value="<?= $status ?>" <?= $qlb['trang_thai'] == $status ? 'selected' : '' ?>><?= $status ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tình trạng thanh toán</label>
                            <select name="tinh_trang_thanh_toan">
                                <?php
                                $types = ['Đã cọc', 'Chưa cọc', 'Chưa thanh toán', 'Đã thanh toán', 'Hủy bỏ'];
                                foreach ($types as $t): ?>
                                    <option value="<?= $t ?>" <?= $qlb['tinh_trang_thanh_toan'] == $t ? 'selected' : '' ?>><?= $t ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group full">
                            <label>Yêu cầu đặc biệt</label>
                            <select name="yeu_cau_dac_biet">
                                <?php
                                $types = ['Ăn chay', 'Yêu cầu về dị ứng', 'Yêu cầu về bệnh lý', 'Yêu cầu về phòng nghỉ', 'Yêu cầu phương tiện di chuyển', 'Yêu cầu ăn uống', 'Khác'];
                                foreach ($types as $t): ?>
                                    <option value="<?= $t ?>" <?= $qlb['yeu_cau_dac_biet'] == $t ? 'selected' : '' ?>><?= $t ?></option>
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

    <script>
        document.querySelectorAll('.album-img').forEach(img => {
            img.addEventListener('click', function() {
                const main = document.createElement('img');
                main.src = this.src;
                main.className = 'album-main';
                this.parentElement.insertBefore(main, this.parentElement.firstChild);
            });
        });
    </script>
</body>

</html>