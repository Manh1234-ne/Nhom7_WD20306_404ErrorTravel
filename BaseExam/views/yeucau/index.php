<!-- views/yeu_cau/index.php -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách yêu cầu đặc biệt</title>
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

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
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
            display: inline-flex;
            align-items: center;
        }

        a.btn i {
            margin-right: 5px;
        }

        a.btn:hover {
            background: #2980b9;
        }

        .flash-success {
            color: green;
            margin-bottom: 15px;
        }

        .flash-error {
            color: red;
            margin-bottom: 15px;
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
        <h2>404 Error Travel</h2>
        <a href="?action=home"><i class="fa fa-home"></i>Trang chủ</a>
        <a href="?action=tours"><i class="fa fa-suitcase"></i>Quản lý tour</a>
        <a href="?action=nhansu"><i class="fa fa-user-tie"></i>Quản lý nhân sự</a>
        <a href="?action=danhmuc"><i class="nav-icon fas fa-th"></i>Quản lý danh mục</a>
        <a href="?action=yeu_cau"><i class="fa fa-star"></i>Yêu cầu đặc biệt</a>
    </div>

    <div class="content">
        <div class="top-bar">
            <h1>Danh sách yêu cầu đặc biệt</h1>
            <a href="index.php?action=yeu_cau_create" class="btn"><i class="fa fa-plus"></i> Thêm yêu cầu mới</a>
        </div>

        <?php if (!empty($_SESSION['flash_success'])): ?>
            <div class="flash-success"><?= $_SESSION['flash_success'];
            unset($_SESSION['flash_success']); ?></div>
        <?php endif; ?>
        <?php if (!empty($_SESSION['flash_error'])): ?>
            <div class="flash-error"><?= $_SESSION['flash_error'];
            unset($_SESSION['flash_error']); ?></div>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Booking / Tour</th>
                    <th>Tên khách</th>
                    <th>Loại yêu cầu</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($danhSach)):
                    foreach ($danhSach as $r): ?>
                        <tr>
                            <td><?= $r['id'] ?></td>
                            <td><?= $r['id_booking'] ?? $r['tour_id'] ?></td>
                            <td><?= htmlspecialchars($r['ten_khach']) ?></td>
                            <td><?= htmlspecialchars($r['loai_yeu_cau']) ?></td>
                            <td><?= nl2br(htmlspecialchars($r['mo_ta'])) ?></td>
                            <td><?= htmlspecialchars($r['trang_thai'] ?? 'Chờ xử lý') ?></td>
                            <td>
                                <a href="index.php?action=yeu_cau_edit&id=<?= $r['id'] ?>" class="btn"><i
                                        class="fa fa-edit"></i></a>
                                <a href="index.php?action=yeu_cau_show&id=<?= $r['id'] ?>" class="btn"><i
                                        class="fa fa-eye"></i></a>
                                <a href="index.php?action=yeu_cau_delete&id=<?= $r['id'] ?>" class="btn"
                                    onclick="return confirm('Xác nhận xóa?')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; else: ?>
                    <tr>
                        <td colspan="7">Chưa có yêu cầu nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>