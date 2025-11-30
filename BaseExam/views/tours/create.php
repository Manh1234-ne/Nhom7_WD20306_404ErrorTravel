<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tạo booking</title>
    <style>
        body {
            background: #f5f5f5;
            font-family: Arial;
            padding: 30px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.12);
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            width: 100%;
            background: #3b82f6;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #2563eb;
        }

        h2 {
            margin-top: 0;
        }

        .group-title {
            font-weight: bold;
            margin-top: 15px;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>Tạo booking</h2>

    <form action="?action=save_booking" method="POST">

        <!-- Ẩn tour_id -->
        <input type="hidden" name="tour_id" value="<?= $tour['id'] ?>">

        <div class="group-title">Thông tin khách hàng</div>

        <input type="text" name="ten_khach" placeholder="Tên khách" required>
        <input type="number" name="so_dien_thoai" placeholder="Số điện thoại" required>
        <input type="email" name="email" placeholder="Email">
        <input type="number" name="cccd" placeholder="CCCD" required>

        <div class="group-title">Chi tiết booking</div>

        <!-- Hiển thị tên tour (không cho sửa) -->
        <input type="text" value="<?= $tour['ten_tour'] ?>" disabled>

        <input type="number" name="so_nguoi" placeholder="Số lượng khách" required>

        <input type="date" name="ngay_khoi_hanh" required>
        <input type="number" name="gia" value="<?= $tour['gia'] ?>" placeholder="Giá" required>

        <input type="text" value="Chờ xác nhận" disabled>
        <input type="hidden" name="trang_thai" value="Chờ xác nhận">

        <label for="group-title">Tình trạng thanh toán</label>
        <input type="text" value="Chờ thanh toán" disabled>
        <input type="hidden" name="tinh_trang_thanh_toan" value="Chờ thanh toán">

        <!-- ⭐ TIỀN CỌC TỰ TÍNH 40% GIÁ TOUR -->
        <?php if ($tour['gia'] > 500000): ?>
            <?php $tien_coc = $tour['gia'] * 0.4; ?>

            <!-- Hiển thị tiền cọc nhưng không cho sửa -->
             <label for="">Tiền cọc</label>
            <input type="text" value="<?= number_format($tien_coc) ?> VND (40% giá tour)" disabled>

            <!-- Gửi tiền cọc vào form -->
            <input type="hidden" name="tien_coc" value="<?= $tien_coc ?>">
        <?php else: ?>
            <input type="hidden" name="tien_coc" value="0">
        <?php endif; ?>

        <label for="group-title">Yêu cầu đặc biệt</label>
        <select name="yeu_cau_dac_biet" required>
            <option value="">-- Chọn loại yêu cầu --</option>
            <option value="">Ăn chay</option>
            <option value="Yêu cầu về dị ứng">Dị ứng</option>
            <option value="Yêu cầu về bệnh lý">Bệnh lý</option>
            <option value="Yêu cầu về phòng nghỉ">Phòng nghỉ</option>
            <option value="Yêu cầu phương tiện di chuyển">Di chuyển</option>
            <option value="Yêu cầu về ăn uống">Ăn uống</option>
            <option value="Khác">Khác</option>
        </select>

        <textarea name="ghi_chu" placeholder="Ghi chú"></textarea>

        <button type="submit">Tạo booking</button>
    </form>

</div>

</body>
</html>
