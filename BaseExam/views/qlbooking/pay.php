<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thanh toán</title>
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

        .card {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.12);
            max-width: 650px;
        }

        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin: 12px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background: #3498db;
            padding: 10px 18px;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #2980b9;
        }

        .btn-back {
            margin-top: 15px;
            display: inline-block;
            padding: 10px 15px;
            background: #7f8c8d;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-back:hover {
            background: #636e72;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h2>Quản lý Tour</h2>
        <a href="?action=home"><i class="fa fa-home"></i>Trang chủ</a>
        <a href="?action=tours"><i class="fa fa-suitcase"></i>Quản lý tour</a>
        <a href="?action=nhansu"><i class="fa fa-user-tie"></i>Quản lý nhân sự</a>
        <a href="?action=danhmuc"><i class="fa fa-th"></i>Quản lý danh mục</a>
        <a href="?action=qlbooking"><i class="fa fa-suitcase"></i>Quản lý booking</a>
        <a href="?action=yeu_cau"><i class="fa fa-star"></i>Ghi chú đặc biệt</a>
    </div>

    <div class="content">
        <h1>Thanh toán</h1>

        <div class="card">

            <h3>Thông tin booking</h3>

            <?php
            $history = new PaymentHistory();
            $list = $history->getByBooking($qlb['id']);
            ?>

            <h3>Lịch sử thanh toán</h3>

            <?php if (count($list) === 0): ?>
                <p>Chưa có lần thanh toán nào.</p>
            <?php else: ?>
                <table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse;">
                    <tr>
                        <th>Số tiền</th>
                        <th>Ngày thanh toán</th>
                    </tr>

                    <?php foreach ($list as $h): ?>
                        <tr>
                            <td><?= number_format($h['so_tien']) ?> VNĐ</td>
                            <td><?= $h['ngay_thanh_toan'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>

            <p><strong>Khách hàng:</strong> <?= htmlspecialchars($qlb['ten_khach']) ?></p>
            <p><strong>SĐT:</strong> <?= $qlb['so_dien_thoai'] ?></p>
            <p><strong>Giá tour:</strong> <?= number_format($qlb['gia']) ?> VNĐ</p>

            <p><strong>Tiền cọc 40%:</strong> <?= number_format($qlb['gia'] * 0.4) ?> VNĐ</p>
            <p><strong>Đã cọc:</strong> <?= number_format($qlb['tien_coc_da_tra'] ?? 0) ?> VNĐ</p>

            <?php
            $tien_coc = $qlb['gia'] * 0.4;
            $da_coc = $qlb['tien_coc_da_tra'] ?? 0;
            $con_coc = max(0, $tien_coc - $da_coc);

            $da_full = $qlb['tien_full_da_tra'] ?? 0;
            $con_full = max(0, $qlb['gia'] - ($da_coc + $da_full));
            ?>

            <p><strong>Còn thiếu cọc:</strong> <?= number_format($con_coc) ?> VNĐ</p>
            <p><strong>Còn thiếu FULL:</strong> <?= number_format($con_full) ?> VNĐ</p>

            <hr>

            <!-- FORM THANH TOÁN -->
            <form action="?action=qlbooking_pay_post" method="POST">

                <input type="hidden" name="id" value="<?= $qlb['id'] ?>">

                <label><strong>Chọn hình thức thanh toán:</strong></label>
                <select name="type" required>
                    <option value="coc">Thanh toán tiền cọc (40%)</option>
                    <option value="full">Thanh toán toàn bộ tour</option>
                </select>

                <label><strong>Nhập số tiền muốn thanh toán:</strong></label>
                <input type="number" name="so_tien" min="1000" required>

                <button type="submit">Xác nhận thanh toán</button>
            </form>

            <a href="?action=qlbooking_detail&id=<?= $qlb['id'] ?>" class="btn-back">← Quay lại</a>

        </div>
    </div>

</body>

</html>