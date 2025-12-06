<!DOCTYPE html>
<html lang="vi">
<<<<<<< HEAD

<head>
    <meta charset="UTF-8">
    <title>Tạo Booking</title>
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
        }

        /* CONTENT */
        .content {
            margin-left: 250px;
            padding: 40px 35px;
        }

        h1 {
            font-size: 28px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 25px;
        }

        form {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 950px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        label {
            font-weight: 600;
            margin-top: 12px;
            display: block;
            color: #334155;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            font-size: 15px;
            background: #f8fafc;
        }

        textarea {
            height: 110px;
        }

        .full-row {
            grid-column: span 2;
        }

        button {
            margin-top: 25px;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            background: #3b82f6;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
=======
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
>>>>>>> lebang271206-ui
            cursor: pointer;
        }

        button:hover {
            background: #2563eb;
        }

<<<<<<< HEAD
        a.back {
            display: inline-block;
            margin-top: 18px;
            color: #3b82f6;
            font-weight: 600;
            text-decoration: none;
=======
        h2 {
            margin-top: 0;
        }

        .group-title {
            font-weight: bold;
            margin-top: 15px;
>>>>>>> lebang271206-ui
        }
    </style>
</head>

<body>

<<<<<<< HEAD
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
        <h1>Tạo Booking</h1>

        <form action="?action=save_booking" method="POST">

            <input type="hidden" name="tour_id" value="<?= $tour['id'] ?>">

            <div class="grid-2">

                <!-- Cột trái -->
                <div>
                    <label>Tên khách</label>
                    <input type="text" name="ten_khach" required>

                    <label>Số điện thoại</label>
                    <input type="number" name="so_dien_thoai" required>

                    <label>Email</label>
                    <input type="email" name="email">

                    <label>CCCD</label>
                    <input type="number" name="cccd" required>
                </div>

                <!-- Cột phải -->
                <div>
                    <label>Tên tour</label>
                    <input type="text" value="<?= $tour['ten_tour'] ?>" disabled>

                    <label>Số lượng khách</label>
                    <input type="number" name="so_nguoi" required>

                    <label>Ngày khởi hành</label>
                    <input type="date" name="ngay_khoi_hanh" required>

                    <label>Giá tour</label>
                    <input type="number" name="gia" value="<?= $tour['gia'] ?>" required>
                </div>

                <!-- Full row -->
                <div class="full-row">
                    <label>Trạng thái</label>
                    <input type="text" value="Chờ xác nhận" disabled>
                    <input type="hidden" name="trang_thai" value="Chờ xác nhận">
                </div>

                <div class="full-row">
                    <label>Tình trạng thanh toán</label>
                    <input type="text" value="Chờ thanh toán" disabled>
                    <input type="hidden" name="tinh_trang_thanh_toan" value="Chờ thanh toán">
                </div>

                <!-- Tiền cọc -->
                <?php if ($tour['gia'] > 500000): ?>
                    <?php $tien_coc = $tour['gia'] * 0.4; ?>

                    <div class="full-row">
                        <label>Tiền cọc</label>
                        <input type="text" value="<?= number_format($tien_coc) ?> VND (40% giá tour)" disabled>
                        <input type="hidden" name="tien_coc" value="<?= $tien_coc ?>">
                    </div>
                <?php else: ?>
                    <input type="hidden" name="tien_coc" value="0">
                <?php endif; ?>

                <div class="full-row">
                    <label>Yêu cầu đặc biệt</label>
                    <select name="yeu_cau_dac_biet" required>
                        <option value="">-- Chọn loại yêu cầu --</option>
                        <option value="Ăn chay">Ăn chay</option>
                        <option value="Dị ứng">Dị ứng</option>
                        <option value="Bệnh lý">Bệnh lý</option>
                        <option value="Phòng nghỉ">Phòng nghỉ</option>
                        <option value="Di chuyển">Phương tiện di chuyển</option>
                        <option value="Ăn uống">Ăn uống</option>
                        <option value="Khác">Khác</option>
                    </select>
                </div>

                <div class="full-row">
                    <label>Ghi chú</label>
                    <textarea name="ghi_chu"></textarea>
                </div>

            </div>

            <button type="submit">Tạo booking</button>
            <a class="back" href="?action=qlbooking">← Quay lại</a>

        </form>
    </div>

</body>

</html>
=======
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
            <?php if ($tour['gia'] > 500000): ?>
    <?php $tienCoc = $tour['gia'] * 0.4; ?>
    <input 
        type="number" 
        name="tien_coc" 
        value="<?= $tienCoc ?>" 
        readonly
    >
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
>>>>>>> lebang271206-ui
