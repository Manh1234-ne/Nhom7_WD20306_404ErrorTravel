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

        /* Nút chung */
        a.btn {
            padding: 10px 16px;
            /* giống quản lý Tour */
            border-radius: 6px;
            /* bo góc mềm */
            color: #fff;
            text-decoration: none;
            margin-right: 6px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            /* khoảng cách icon-text */
            font-size: 15px;
            /* kích thước chữ như Tour */
            transition: 0.2s;
        }

        /* Nút Thêm */
        .btn-add {
            background: #3b82f6;
            /* xanh dương */
        }

        .btn-add:hover {
            background: #2563eb;
        }

        /* Nút Xem */
        .btn-view {
            background: #0ea5e9;
            /* xanh da trời */
        }

        .btn-view:hover {
            background: #0284c7;
        }

        /* Nút Sửa */
        .btn-edit {
            background: #f59e0b;
            /* cam */
        }

        .btn-edit:hover {
            background: #d97706;
        }

        /* Nút Xóa */
        .btn-delete {
            background: #ef4444;
            /* đỏ */
        }

        .btn-delete:hover {
            background: #b91c1c;
        }


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

        <h2>Quản lý Tour</h2>
        <a href="?action=home"><i class="fa fa-home"></i>Trang chủ</a>
        <a href="?action=tours"><i class="fa fa-suitcase"></i>Quản lý tourr</a>
        <a href="?action=nhansu"><i class="fa fa-user-tie"></i>Quản lý nhân sự</a>
        <a href="?action=danhmuc"><i class="nav-icon fas fa-th"></i>Quản lý danh mục</a>
        <a href="?action=qlbooking"><i class="fa fa-suitcase"></i>Quản lý booking</a>
        <a href="?action=yeu_cau"><i class="fa fa-star"></i>Ghi chú đặc biệt</a>

    </div>
    <div class="content">
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
    </div>
</body>

</html>