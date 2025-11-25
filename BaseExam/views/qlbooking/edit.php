<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa booking</title>
    <style>
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
        <label>Số người</label>
        <textarea name="so_nguoi"><?= $qlb['so_nguoi'] ?></textarea>
        <label>Ngày khởi hành</label>
        <textarea name="ngay_khoi_hanh"><?= $qlb['ngay_khoi_hanh'] ?></textarea>
        <label>Trạng thái</label>
        <textarea name="trang_thai"><?= $qlb['trang_thai'] ?></textarea>
        <label>Tình trạng thanh toán</label>
        <textarea name="tinh_trang_thanh_toan"><?= $qlb['tinh_trang_thanh_toan'] ?></textarea>
        <label>Yêu cầu đặc biệt</label>
        <textarea name="yeu_cau_dac_biet"><?= $qlb['yeu_cau_dac_biet'] ?></textarea>
        <button type="submit">Cập nhật booking</button>
        <a href="?action=qlbooking">Quay lại</a>
    </form>
</body>
</html>
