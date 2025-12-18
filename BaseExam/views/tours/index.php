<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách Tour</title>
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
            margin: 0;
            font-size: 28px;
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

        .btn-add:hover {
            background: #2563eb;
        }

        /* TABLE STYLE */
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
            color: white;
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

        img {
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        /* BUTTON ACTION */
        .btn {
            padding: 7px 10px;
            border-radius: 5px;
            background: #64748b;
            color: #fff;
            text-decoration: none;
            margin-right: 4px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            transition: 0.2s;
        }

        .btn:hover {
            opacity: 0.85;
        }

        .btn-view {
            background: #0ea5e9;
        }

        .btn-edit {
            background: #f59e0b;
        }

        .btn-delete {
            background: #ef4444;
        }

        @media(max-width: 768px) {
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

    <!-- MAIN CONTENT -->
    <div class="content">
        <div class="top-bar">
            <h1>Danh sách Tour</h1>
            <a href="?action=tour_add" class="btn-add">
                <i class="fa fa-plus"></i> Thêm Tour
            </a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Tour</th>
                    <th>Loại Tour</th>
                    <th>Mô tả</th>
                    <th>Giá</th>
                    <th>Chính sách</th>
                    <th>Nhà cung cấp</th>
                    <th>Mùa</th>
                    <th>Hình ảnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($tours as $tour): ?>
                    <tr>
                        <td><?= $tour['id'] ?></td>
                        <td><?= htmlspecialchars($tour['ten_tour']) ?></td>
                        <td><?= $tour['loai_tour'] ?></td>
                        <td><?= htmlspecialchars($tour['mo_ta']) ?></td>
                        <td><?= number_format($tour['gia'], 0, ',', '.') ?> VNĐ</td>
                        <td><?= htmlspecialchars($tour['chinh_sach']) ?></td>
                        <td><?= htmlspecialchars($tour['nha_cung_cap']) ?></td>
                        <td><?= $tour['mua'] ?></td>

                        <td>
                            <?php if ($tour['hinh_anh']): ?>
                                <img src="assets/uploads/<?= $tour['hinh_anh'] ?>" width="80">
                            <?php endif; ?>
                        </td>

                        <td>
                            <a href="?action=tour_detail&id=<?= $tour['id'] ?>" class="btn btn-view">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="?action=tour_edit&id=<?= $tour['id'] ?>" class="btn btn-edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="?action=tour_delete&id=<?= $tour['id'] ?>" class="btn btn-delete"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

    </div>

</body>

</html>
