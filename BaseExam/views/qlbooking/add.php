<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm booking</title>
    <style>
        body {
            font-family: Arial;
            background: #f5f5f5;
            padding: 30px;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 600px;
            margin: auto;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-top: 15px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background: #3498db;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background: #2980b9;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            color: #3498db;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <h1>Thêm booking</h1>
    <form action="?action=qlbooking_add_post" method="post" enctype="multipart/form-data">
        <label>Đơn đặt</label>
        <input type="number" name="dat_tour_id" required>
        <label>Họ tên</label>
        <input type="text" name="ho_ten" required>
        <label>Giới tính</label>
        <textarea name="gioi_tinh"></textarea>
        <label>Năm sinh</label>
        <input type="number" name="nam_sinh">
        <label>Số giấy tờ</label>
        <textarea name="so_giay_to"></textarea>
        <label>Loại phòng</label>
        <textarea name="loai_phong"></textarea>
        <label>Tình trạng thanh toán</label>
        <input type="text" name="tinh_trang_thanh_toan" required>
        <label>Yêu cầu đặc biệt</label>
        <input type="text" name="yeu_cau_dac_biet">
        <button type="submit">Thêm booking</button>
        <a href="?action=qlbooking">Quay lại</a>
    </form>
</body>

</html>