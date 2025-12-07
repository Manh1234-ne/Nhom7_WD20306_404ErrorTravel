<!DOCTYPE html>
<html lang="vi">
<<<<<<< HEAD

=======
>>>>>>> lebang271206-ui
<head>
    <meta charset="UTF-8">
    <title>Sửa booking</title>
    <style>
<<<<<<< HEAD
        body {
            font-family: Arial, sans-serif;
            background: #eef2f7;
            margin: 0;
            padding: 30px;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        /* GRID 2 CỘT */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 6px;
            font-weight: bold;
            color: #444;
        }

        input,
        textarea,
        select {
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 15px;
        }

        textarea {
            height: 42px;
        }

        /* FULL WIDTH SECTION */
        .full {
            grid-column: span 2;
        }

        button {
            margin-top: 20px;
            padding: 12px 20px;
            background: #3498db;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #2980b9;
        }

        a {
            display: inline-block;
            margin-top: 12px;
            color: #3498db;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Sửa booking</h1>

        <form action="?action=qlbooking_edit_post" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $qlb['id'] ?>">

            <div class="form-grid">

                <div class="form-group">
                    <label>Tên khách</label>
                    <textarea name="ten_khach"><?= $qlb['ten_khach'] ?></textarea>
                </div>

                <div class="form-group">
                    <label>Số điện thoại</label>
                    <textarea name="so_dien_thoai"><?= $qlb['so_dien_thoai'] ?></textarea>
                </div>

                <div class="form-group">
                    <label>CCCD</label>
                    <textarea name="cccd"><?= $qlb['cccd'] ?></textarea>
                </div>

                <div class="form-group">
                    <label>Số người</label>
                    <textarea name="so_nguoi"><?= $qlb['so_nguoi'] ?></textarea>
                </div>

                <div class="form-group">
                    <label>Ngày khởi hành</label>
                    <textarea name="ngay_khoi_hanh"><?= $qlb['ngay_khoi_hanh'] ?></textarea>
                </div>

                <div class="form-group">
                    <label>Giá</label>
                    <textarea name="gia"><?= $qlb['gia'] ?></textarea>
                </div>

                <div class="form-group">
                    <label>Trạng thái</label>
                    <select name="trang_thai">
                        <?php
                        $statuses = ['Chưa xác nhận', 'Đã xác nhận', 'Đặt thành công', 'Đã hủy tour'];
                        foreach ($statuses as $status): ?>
                            <option value="<?= $status ?>" <?= $qlb['trang_thai'] == $status ? 'selected' : '' ?>>
                                <?= $status ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tình trạng thanh toán</label>
                    <select name="tinh_trang_thanh_toan">
                        <?php
                        $types = ['Đã cọc', 'Chưa cọc', 'Chưa thanh toán', 'Đã thanh toán', 'Hủy bỏ'];
                        foreach ($types as $t): ?>
                            <option value="<?= $t ?>" <?= $qlb['tinh_trang_thanh_toan'] == $t ? 'selected' : '' ?>>
                                <?= $t ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group full">
                    <label>Yêu cầu đặc biệt</label>
                    <select name="yeu_cau_dac_biet">
                        <?php
                        $types = [
                            'Ăn chay',
                            'Yêu cầu về dị ứng',
                            'Yêu cầu về bệnh lý',
                            'Yêu cầu về phòng nghỉ',
                            'Yêu cầu phương tiện di chuyển',
                            'Yêu cầu ăn uống',
                            'Khác'
                        ];
                        foreach ($types as $t): ?>
                            <option value="<?= $t ?>" <?= $qlb['yeu_cau_dac_biet'] == $t ? 'selected' : '' ?>>
                                <?= $t ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>

            <button type="submit">Cập nhật booking</button>
            <a href="?action=qlbooking">Quay lại</a>
        </form>
    </div>
</body>

=======
        body { 
        font-family: Arial; 
        background:#f5f5f5; 
        padding:30px; 
    }
        form { 
            background:#fff; 
            padding:20px; 
            border-radius:8px; 
            width:600px; 
            margin:auto; 
            box-shadow:0 2px 5px rgba(0,0,0,0.1);
        }
        label { 
            display:block; 
            margin-top:15px; 
        }
        input, textarea, select { 
            width:100%; 
            padding:8px; 
            margin-top:5px; 
            border-radius:4px; 
            border:1px solid #ccc; 
        }
        button { 
            margin-top:20px; 
            padding:10px 20px; 
            border:none; 
            border-radius:4px; 
            background:#3498db; 
            color:#fff; 
            cursor:pointer; 
        }
        button:hover { 
            background:#2980b9; 
        }
        a { 
            display:inline-block; 
            margin-top:10px; 
            color:#3498db; 
            text-decoration:none; 
        }
    </style>
</head>
<body>
    <h1>Sửa booking</h1>
    <form action="?action=qlbooking_edit_post" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $qlb['id'] ?>">
        <label>Tên khách</label>
        <textarea name="ten_khach"><?= $qlb['ten_khach'] ?></textarea>
        <label>Số điện thoại</label>
        <textarea name="so_dien_thoai"><?= $qlb['so_dien_thoai'] ?></textarea>
         <label>CCCD</label>
        <textarea name="cccd"><?= $qlb['cccd'] ?></textarea>
        <label>Số người</label>
        <textarea name="so_nguoi"><?= $qlb['so_nguoi'] ?></textarea>
        <label>Ngày khởi hành</label>
        <textarea name="ngay_khoi_hanh"><?= $qlb['ngay_khoi_hanh'] ?></textarea>
         <label>Giá</label>
        <textarea name="gia"><?= $qlb['gia'] ?></textarea>
        <label>Trạng thái</label>
        <textarea name="trang_thai"><?= $qlb['trang_thai'] ?></textarea>
       <label>Tình trạng thanh toán</label>
            <select name="tinh_trang_thanh_toan">
                <?php
                $types = ['Đã cọc','Chưa cọc','Chưa thanh toán', 'Đã thanh toán', 'Hủy bỏ'];
                foreach ($types as $t): ?>
                    <option value="<?= $t ?>" <?= $qlb['tinh_trang_thanh_toan']==$t?'selected':'' ?>><?= $t ?></option>
                <?php endforeach; ?>
            </select>
        <label>Yêu cầu đặc biệt</label>
            <select name="yeu_cau_dac_biet">
                <?php
                $types = ['Ăn chay','Yêu cầu về dị ứng','Yêu cầu về bệnh lý','Yêu cầu về phòng nghỉ','Yêu cầu phương tiện di chuyển','Yêu cầu ăn uống','Khác'];
                foreach ($types as $t): ?>
                    <option value="<?= $t ?>" <?= $qlb['yeu_cau_dac_biet']==$t?'selected':'' ?>><?= $t ?></option>
                <?php endforeach; ?>
            </select>
        <button type="submit">Cập nhật booking</button>
        <a href="?action=qlbooking">Quay lại</a>
    </form>
</body>
>>>>>>> lebang271206-ui
</html>
