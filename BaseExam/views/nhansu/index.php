<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách Nhân sự</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #eef2f7;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background: #1e293b;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            color: #fff;
            padding-top: 20px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.2);
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

        .sidebar i { margin-right: 12px; }

        /* CONTENT */
        .content {
            margin-left: 250px;
            padding: 40px 35px;
        }

        h1 {
            font-size: 28px;
            margin: 0;
            font-weight: 600;
            color: #1e293b;
        }

        /* TOP BAR */
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

        .btn-add:hover { background: #2563eb; }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        th {
            background: #3b82f6;
            color: #fff;
            padding: 14px;
            font-weight: 600;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #e5e7eb;
        }

        tr:hover td { background: #f1f5f9; }

        /* BUTTONS */
        .btn {
            padding: 7px 10px;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            margin-right: 5px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: 0.2s;
        }

        .btn-view { background: #0ea5e9; }
        .btn-edit { background: #f59e0b; }
        .btn-delete { background: #ef4444; }

        .btn:hover { opacity: 0.85; }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>404 Error Travel</h2>
        <a href="?action=home"><i class="fa fa-home"></i>Trang chủ</a>
        <a href="?action=tours"><i class="fa fa-suitcase"></i>Quản lý tour</a>
        <a href="?action=nhansu"><i class="fa fa-user-tie"></i>Quản lý nhân sự</a>
        <a href="?action=danhmuc"><i class="fa fa-th"></i>Quản lý danh mục</a>
        <a href="?action=qlbooking"><i class="fa fa-ticket"></i>Quản lý booking</a>
        <a href="?action=yeu_cau"><i class="fa fa-star"></i>Ghi chú đặc biệt</a>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <div class="top-bar">
            <h1>Danh sách Nhân sự</h1>
            <a href="?action=nhansu_add" class="btn-add">
                <i class="fa fa-plus"></i> Thêm Nhân sự
            </a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Ngôn ngữ</th>
                    <th>Kinh nghiệm</th>
                    <th>Đánh giá</th>
                    <th>Vai trò</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($nhansu)): ?>
                    <?php foreach ($nhansu as $ns): ?>
                        <tr>
                            <td><?= $ns['nguoi_dung_id'] ?></td>
                            <td><?= htmlspecialchars($ns['ho_ten']) ?></td>
                            <td><?= $ns['email'] ?></td>
                            <td><?= $ns['so_dien_thoai'] ?></td>
                            <td><?= $ns['ngon_ngu'] ?></td>
                            <td><?= $ns['kinh_nghiem'] ?></td>
                            <td><?= $ns['danh_gia'] ?></td>
                            <td><?= htmlspecialchars($ns['vai_tro']) ?></td>

                            <td>
                                <a href="?action=nhansu_edit&id=<?= $ns['id'] ?>" class="btn btn-edit">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <a href="?action=nhansu_delete&id=<?= $ns['id'] ?>" 
                                   class="btn btn-delete"
                                   onclick="return confirm('Bạn có chắc muốn xóa?')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="9" style="text-align:center;">Không có dữ liệu</td></tr>
                <?php endif; ?>
            </tbody>

        </table>

    </div>

</body>
</html>
