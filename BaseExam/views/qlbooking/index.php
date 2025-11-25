<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
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
        <h2>Quản lý Tour</h2>
        <a href="?action=home"><i class="fa fa-home"></i>Trang chủ</a>
        <a href="?action=tours"><i class="fa fa-suitcase"></i>Quản lý tourr</a>
        <a href="?action=nhansu"><i class="fa fa-user-tie"></i>Quản lý nhân sự</a>
        <a href="?action=danhmuc"><i class="nav-icon fas fa-th"></i>Quản lý danh mục</a>
<a href="?action=qlbooking"><i class="fa fa-suitcase"></i>Quản lý booking</a>
        <a href="?action=yeu_cau"><i class="fa fa-star"></i>Ghi chú đặc biệt</a>

    </div>
    <div class="content">
        <div class="top-bar">
            <h1>Danh sách Quản lí Booking</h1>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên khách</th>
                    <th>Số điện thoại</th>
                    <th>Số người</th>
                    <th>Ngày khởi hành</th>
                    <th>Trạng thái</th>
                    <th>Tình trạng thanh toán</th>
                    <th>Yêu cầu đặc biệt</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($qlbooking as $qlb): ?>
                    <tr>
                       <td><?= $qlb['id'] ?></td>
                            <td><?= htmlspecialchars($qlb['ten_khach']) ?></td>
                            <td><?= $qlb['so_dien_thoai'] ?></td>
                            <td><?= $qlb['so_nguoi'] ?></td>
                            <td><?= $qlb['ngay_khoi_hanh'] ?></td>
                            <td><?= $qlb['trang_thai'] ?></td>
                            <td><?= $qlb['tinh_trang_thanh_toan'] ?></td>
                            <td><?= $qlb['yeu_cau_dac_biet'] ?></td>
                            
                           <td> 
                            <a href="?action=tour_detail&id=<?= $tour['id'] ?>" class="btn">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="?action=qlbooking_edit&id=<?= $qlb['id'] ?>" class="btn"><i class="fa fa-edit"></i></a>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
