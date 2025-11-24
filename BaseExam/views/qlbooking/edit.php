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
        <label>Đơn đặt</label>
        <textarea name="dat_tour_id"><?= $qlb['dat_tour_id'] ?></textarea>
        <label>Họ tên</label>
        <textarea name="ho_ten"><?= $qlb['ho_ten'] ?></textarea>
        <label>Giới tính</label>
        <textarea name="gioi_tinh"><?= $qlb['gioi_tinh'] ?></textarea>
        <label>Năm sinh</label>
        <textarea name="nam_sinh"><?= $qlb['nam_sinh'] ?></textarea>
        <label>Số giấy tờ</label>
        <textarea name="so_giay_to"><?= $qlb['so_giay_to'] ?></textarea>
        <label>Loại phòng</label>
        <textarea name="loai_phong"><?= $qlb['loai_phong'] ?></textarea>
        <label>Tình trạng thanh toán</label>
        <textarea name="tinh_trang_thanh_toan"><?= $qlb['tinh_trang_thanh_toan'] ?></textarea>
        <label>Yêu cầu đặc biệt</label>
        <textarea name="yeu_cau_dac_biet"><?= $qlb['yeu_cau_dac_biet'] ?></textarea>
        <button type="submit">Cập nhật booking</button>
        <a href="?action=qlbooking">Quay lại</a>
    </form>
</body>
</html>
