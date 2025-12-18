<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách Khách hàng từ File Upload</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #2980b9;
            margin-bottom: 20px;
        }

        .guest-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .guest-table th,
        .guest-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .guest-table th {
            background-color: #f2f2f2;
        }

        .status-pending {
            color: #e67e22;
            font-weight: bold;
        }

        .status-processed {
            color: #2ecc71;
            font-weight: bold;
        }

        .btn-add {
            background: #3498db;
            color: white;
            padding: 8px 15px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-view-file {
            background: #95a5a6;
            color: white;
            padding: 8px 15px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            margin-left: 5px;
        }

        .alert-info {
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .alert-success {
            background: #dff0d8;
            color: #3c763d;
        }

        .alert-error {
            background: #f2dede;
            color: #a94442;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>📑 Danh sách Khách hàng từ File Upload</h1>
        <p>Quản lý tập trung các file Excel danh sách khách đã được đính kèm vào các Booking (Bảng dat_tour).</p>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert-info alert-success">Thành công: <?= htmlspecialchars($_GET['success']) ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['error'])): ?>
            <div class="alert-info alert-error">Lỗi: <?= htmlspecialchars($_GET['error']) ?></div>
        <?php endif; ?>

        <?php if (!empty($file_list)): ?>
            <table class="guest-table">
                <thead>
                    <tr>
                        <th>Mã Booking</th>
                        <th>Người đặt</th>
                        <th>SL Đặt</th>
                        <th>Tên File Gốc</th>
                        <th>Trạng thái Import</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($file_list as $file): ?>
                        <tr>
                            <td>
                                <a href="?action=qlbooking_detail&id=<?= htmlspecialchars($file['booking_id']) ?>">
                                    #<?= htmlspecialchars($file['booking_id']) ?>
                                </a>
                            </td>
                            <td><?= htmlspecialchars($file['ten_khach_dat']) ?></td>
                            <td><?= htmlspecialchars($file['so_nguoi_dat']) ?></td>
                            <td><?= htmlspecialchars($file['original_name']) ?></td>
                            <td>
                                <?php if ($file['trang_thai_khach'] == 1): ?>
                                    <span class="status-processed"><i class="fa fa-check-circle"></i> Đã xử lý</span>
                                <?php else: ?>
                                    <span class="status-pending"><i class="fa fa-hourglass-half"></i> Chờ xử lý</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="?action=qlbooking_view_file&file=<?= urlencode($file['file_name']) ?>"
                                    class="btn-view-file"
                                    target="_blank">
                                    <i class="fa fa-download"></i> Tải File
                                </a>

                                <?php if ($file['trang_thai_khach'] == 0): ?>
                                    <a href="?action=guest_list_import&id=<?= htmlspecialchars($file['booking_id']) ?>&file=<?= urlencode($file['file_name']) ?>"
                                        class="btn-add"
                                        onclick="return confirm('Xác nhận: Thao tác này sẽ xóa và thay thế toàn bộ danh sách khách cũ. Tiếp tục?');">
                                        <i class="fa fa-plus-circle"></i> ADD (Import)
                                    </a>
                                <?php else: ?>
                                    <a href="?action=tour_guest&id=<?= htmlspecialchars($file['booking_id']) ?>" class="btn-view-file">
                                        <i class="fa fa-users"></i> Xem DS Khách
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Không có Booking nào có file danh sách khách hàng (Excel) được đính kèm.</p>
        <?php endif; ?>
    </div>
</body>

</html>