<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Tạo Booking</title>
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
            cursor: pointer;
        }

        button:hover {
            background: #2563eb;
        }

        a.back {
            display: inline-block;
            margin-top: 18px;
            color: #3b82f6;
            font-weight: 600;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="content">
        <h1>Tạo Booking</h1>

        <!-- ✅ FORM DUY NHẤT + enctype -->
        <form action="?action=save_booking" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="tour_id" value="<?= $tour['id'] ?>">

            <div class="grid-2">

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

                <div class="full-row">
                    <input type="hidden" name="trang_thai" value="Chờ xác nhận">
                    <input type="hidden" name="tinh_trang_thanh_toan" value="Chờ thanh toán">
                </div>

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
                    <label>Danh sách khách (Excel)</label>
                    <input type="file" name="danh_sach_file" accept=".xls,.xlsx">
                </div>

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