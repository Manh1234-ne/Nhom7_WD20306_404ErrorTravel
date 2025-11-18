<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Nhân sự</title>
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
            box-shadow: 0 2px 5px rgba(0,0,0,0.1); 
        }
        label { 
            display: block; 
            margin-top: 15px; 
        }
        input, textarea, select { 
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
    <h2>Sửa Hướng dẫn viên</h2>

    <form action="?action=nhansu_edit_post&id=<?= $nhansu['id'] ?>" method="post">
        <div>
            <label>Họ tên:</label>
            <input type="text" name="ho_ten" value="<?= htmlspecialchars($nhansu['ho_ten']) ?>" required>
        </div>

        <div>
            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($nhansu['email']) ?>" required>
        </div>

        <div>
            <label>Số điện thoại:</label>
            <input type="text" name="so_dien_thoai" value="<?= htmlspecialchars($nhansu['so_dien_thoai']) ?>" required>
        </div>

        <div>
            <label>Ngôn ngữ:</label>
            <input type="text" name="ngon_ngu" value="<?= htmlspecialchars($nhansu['ngon_ngu']) ?>" required>
        </div>

        <div>
            <label>Kinh nghiệm:</label>
            <textarea name="kinh_nghiem" rows="4"><?= htmlspecialchars($nhansu['kinh_nghiem']) ?></textarea>
        </div>

        <div>
            <label>Đánh giá:</label>
            <input type="number" name="danh_gia" min="0" max="5" step="0.1" value="<?= htmlspecialchars($nhansu['danh_gia']) ?>">
        </div>

        <div>
            <label>Vai trò:</label>
            <?php if (isset($nhansu['vai_tro']) && $nhansu['vai_tro'] == 'admin'): ?>
                <!-- Nếu nhân sự là admin thì cho đổi vai trò -->
                <select name="vai_tro">
                    <option value="huong_dan_vien" <?= $nhansu['vai_tro'] == 'huong_dan_vien' ? 'selected' : '' ?>>Hướng dẫn viên</option>
                    <option value="admin" <?= $nhansu['vai_tro'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="khach_hang" <?= $nhansu['vai_tro'] == 'khach_hang' ? 'selected' : '' ?>>Khách hàng</option>
                    <option value="nguoi_dung" <?= $nhansu['vai_tro'] == 'nguoi_dung' ? 'selected' : '' ?>>Người dùng</option>
                </select>
            <?php else: ?>
                <!-- Nếu không phải admin thì không đổi -->
                <input type="text" value="<?= htmlspecialchars($nhansu['vai_tro']) ?>" disabled>
            <?php endif; ?>
        </div>

        <div>
            <button type="submit">Cập nhật</button>
        </div>
    </form>

</body>
</html>
