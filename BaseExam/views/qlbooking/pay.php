<?php
// ===============================
// TÍNH TOÁN THANH TOÁN
// ===============================
$gia = $qlb['gia'];

$da_coc  = $qlb['tien_coc_da_tra'] ?? 0;
$da_full = $qlb['tien_full_da_tra'] ?? 0;

$tong_da_tra = $da_coc + $da_full;
$con_thieu_full = max(0, $gia - $tong_da_tra);

$tien_coc = $gia * 0.4;
$con_coc  = max(0, $tien_coc - $da_coc);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thanh toán</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;

            /* CĂN GIỮA */
            display: flex;
            justify-content: center;
            padding-top: 40px;
        }

        .content {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .card {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.12);
            max-width: 720px;
            width: 100%;
        }

        h1 {
            text-align: center;
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
            width: 100%;
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
            text-align: center;
        }

        .btn-back:hover {
            background: #636e72;
        }

        .paid-full {
            color: green;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        table th {
            background: #eee;
        }
    </style>
</head>

<body>

    <div class="content">
        <div class="card">

            <h1>Thanh toán Booking</h1>

            <!-- ĐÃ THANH TOÁN ĐỦ -->
            <?php if ($con_thieu_full == 0): ?>
                <p class="paid-full">
                    Đã thanh toán đủ — không thể thanh toán thêm.
                </p>
            <?php endif; ?>

            <!-- LỊCH SỬ THANH TOÁN -->
            <h3>Lịch sử thanh toán</h3>

            <?php
            $history = new PaymentHistory();
            $list = $history->getByBooking($qlb['id']);
            ?>

            <?php if (count($list) === 0): ?>
                <p>Chưa có lần thanh toán nào.</p>
            <?php else: ?>
                <table>
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

            <!-- THÔNG TIN BOOKING -->
            <p><strong>Khách hàng:</strong> <?= htmlspecialchars($qlb['ten_khach']) ?></p>
            <p><strong>SĐT:</strong> <?= htmlspecialchars($qlb['so_dien_thoai']) ?></p>
            <p><strong>Giá tour:</strong> <?= number_format($gia) ?> VNĐ</p>

            <p><strong>Tiền cọc 40%:</strong> <?= number_format($tien_coc) ?> VNĐ</p>
            <p><strong>Đã cọc:</strong> <?= number_format($da_coc) ?> VNĐ</p>
            <p><strong>Còn thiếu cọc:</strong> <?= number_format($con_coc) ?> VNĐ</p>
            <p><strong>Còn thiếu FULL:</strong> <?= number_format($con_thieu_full) ?> VNĐ</p>

            <hr>

            <!-- FORM THANH TOÁN -->
            <?php if ($con_thieu_full > 0): ?>
                <form action="?action=qlbooking_pay_post" method="POST">
                    <input type="hidden" name="id" value="<?= $qlb['id'] ?>">

                    <label><strong>Hình thức thanh toán</strong></label>
                    <select name="type" required>
                        <option value="coc">Thanh toán tiền cọc (40%)</option>
                        <option value="full">Thanh toán toàn bộ tour</option>
                    </select>

                    <label><strong>Số tiền thanh toán</strong></label>
                    <input type="number"
                        name="so_tien"
                        min="1000"
                        max="<?= $con_thieu_full ?>"
                        required>

                    <button type="submit">Xác nhận thanh toán</button>
                </form>
            <?php endif; ?>

            <div style="text-align:center;">
                <a href="?action=qlbooking&id=<?= $qlb['id'] ?>" class="btn-back">
                    ← Quay lại
                </a>
            </div>

        </div>
    </div>

</body>

</html>