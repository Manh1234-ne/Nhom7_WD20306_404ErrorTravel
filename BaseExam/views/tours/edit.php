<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Tour</title>
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
    <h1>Sửa Tour</h1>
    <form action="?action=tour_edit_post" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $tour['id'] ?>">
        <label>Tên Tour</label>
        <input type="text" name="ten_tour" value="<?= htmlspecialchars($tour['ten_tour']) ?>" required>
        <label>Loại Tour</label>
        <select name="loai_tour">
            <option value="trong_nuoc" <?= $tour['loai_tour']=='trong_nuoc'?'selected':'' ?>>Trong nước</option>
            <option value="quoc_te" <?= $tour['loai_tour']=='quoc_te'?'selected':'' ?>>Quốc tế</option>
            <option value="yeu_cau" <?= $tour['loai_tour']=='yeu_cau'?'selected':'' ?>>Yêu cầu</option>
        </select>
        <label>Mô tả</label>
        <textarea name="mo_ta"><?= $tour['mo_ta'] ?></textarea>
        <label>Giá</label>
        <input type="number" name="gia" value="<?= $tour['gia'] ?>">
        <label>Chính sách</label>
        <textarea name="chinh_sach"><?= $tour['chinh_sach'] ?></textarea>
        <label>Hình ảnh</label>
        <input type="file" name="hinh_anh">
        <?php if($tour['hinh_anh']): ?>
            <img src="assets/uploads/<?= $tour['hinh_anh'] ?>" width="120">
        <?php endif; ?>
        <label>Nhà cung cấp</label>
        <input type="text" name="nha_cung_cap" value="<?= htmlspecialchars($tour['nha_cung_cap']) ?>">
        <label>Mùa</label>
        <select name="mua">
            <option value="mua_xuan" <?= $tour['mua']=='mua_xuan'?'selected':'' ?>>Mùa Xuân</option>
            <option value="mua_ha" <?= $tour['mua']=='mua_ha'?'selected':'' ?>>Mùa Hạ</option>
            <option value="mua_thu" <?= $tour['mua']=='mua_thu'?'selected':'' ?>>Mùa Thu</option>
            <option value="mua_dong" <?= $tour['mua']=='trong_dong'?'selected':'' ?>>Mùa Đông</option>
            </select>
        <button type="submit">Cập nhật Tourr</button>
        <a href="?action=tours">Quay lại</a>
    </form>
</body>
</html>
