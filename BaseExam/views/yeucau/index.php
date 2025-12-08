<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Ghi chú đặc biệt</title>
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


        @media(max-width:768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
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
            <h1>Ghi chú đặc biệt</h1>
            <a href="?action=yeu_cau_create" class="btn-add"><i class="fa fa-plus"></i> Thêm yêu cầu</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên khách</th>
                    <th>Loại yêu cầu</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($danhSach)): ?>
                    <?php foreach ($danhSach as $r): ?>
                        <tr>
                            <td><?= $r['id'] ?></td>
                            <td><?= htmlspecialchars($r['ten_khach']) ?></td>
                            <td><?= htmlspecialchars($r['loai_yeu_cau']) ?></td>
                            <td><?= nl2br(htmlspecialchars($r['mo_ta'])) ?></td>
                            <td><?= htmlspecialchars($r['trang_thai'] ?? 'Chờ xử lý') ?></td>
                            <td>
                                <a href="?action=yeu_cau_edit&id=<?= $r['id'] ?>" class="btn btn-edit"><i class="fa fa-edit"></i></a>
                                <a href="?action=yeu_cau_show&id=<?= $r['id'] ?>" class="btn btn-view"><i class="fa fa-eye"></i></a>
                                <a href="?action=yeu_cau_delete&id=<?= $r['id'] ?>" class="btn btn-delete" onclick="return confirm('Xác nhận xóa?')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align:center; padding:20px;">Chưa có yêu cầu nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>