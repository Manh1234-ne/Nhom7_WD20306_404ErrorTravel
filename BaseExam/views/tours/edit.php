<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Tour</title>
    <style>
        body {
            font-family: Arial;
            background: #f5f5f5;
            padding: 30px;
        }

        .container {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .tour-form {
            width: 350px;
        }

        .album-form {
            width: 500px; /* album rộng hơn */
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        img {
            max-width: 120px;
        }

        h2 {
            margin-top: 0;
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
    <h1 style="text-align:center;">Sửa Tour</h1>
    <div class="container">
        <!-- Bảng thông tin tour -->
        <form action="?action=tour_edit_post" method="post" enctype="multipart/form-data" class="tour-form">
            <input type="hidden" name="id" value="<?= $tour['id'] ?>">
            <h2>Thông tin Tour</h2>

            <label>Tên Tour</label>
            <input type="text" name="ten_tour" value="<?= htmlspecialchars($tour['ten_tour']) ?>" required>

            <label>Loại Tour</label>
            <select name="loai_tour">
                <option value="trong_nuoc" <?= $tour['loai_tour'] == 'trong_nuoc' ? 'selected' : '' ?>>Trong nước</option>
                <option value="quoc_te" <?= $tour['loai_tour'] == 'quoc_te' ? 'selected' : '' ?>>Quốc tế</option>
                <option value="yeu_cau" <?= $tour['loai_tour'] == 'yeu_cau' ? 'selected' : '' ?>>Yêu cầu</option>
            </select>

            <label>Mô tả</label>
            <textarea name="mo_ta"><?= htmlspecialchars($tour['mo_ta']) ?></textarea>

            <label>Giá</label>
            <input type="number" name="gia" value="<?= $tour['gia'] ?>">

            <label>Chính sách</label>
            <textarea name="chinh_sach"><?= htmlspecialchars($tour['chinh_sach']) ?></textarea>

            <label>Hình ảnh hiện tại</label>
            <?php if ($tour['hinh_anh']): ?>
                <img src="assets/uploads/tour/<?= $tour['hinh_anh'] ?>" width="120">
            <?php endif; ?>

            <label>Thay đổi hình ảnh</label>
            <input type="file" name="hinh_anh">

            <label>Nhà cung cấp</label>
            <input type="text" name="nha_cung_cap" value="<?= htmlspecialchars($tour['nha_cung_cap'] ?? '') ?>">

            <label>Mùa</label>
            <select name="mua">
                <option value="mua_xuan" <?= ($tour['mua'] ?? '') == 'mua_xuan' ? 'selected' : '' ?>>Mùa Xuân</option>
                <option value="mua_ha" <?= ($tour['mua'] ?? '') == 'mua_ha' ? 'selected' : '' ?>>Mùa Hạ</option>
                <option value="mua_thu" <?= ($tour['mua'] ?? '') == 'mua_thu' ? 'selected' : '' ?>>Mùa Thu</option>
                <option value="mua_dong" <?= ($tour['mua'] ?? '') == 'mua_dong' ? 'selected' : '' ?>>Mùa Đông</option>
            </select>

            <button type="submit">Cập nhật Tour</button>
        </form>

        <!-- Bảng quản lý album -->
        <form action="?action=album_edit_post" method="post" enctype="multipart/form-data" class="album-form">
            <input type="hidden" name="tour_id" value="<?= $tour['id'] ?>">
            <h2>Album ảnh</h2>

            <?php if (!empty($album)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Ảnh</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($album as $img): ?>
                            <tr>
                                <td><img src="assets/uploads/tour/album/<?= $img->file_name ?>" alt="Ảnh"></td>
                                <td>
                                    <input type="checkbox" name="delete_album[]" value="<?= $img->id ?>"> Xóa
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Chưa có ảnh trong album.</p>
            <?php endif; ?>

            <label>Thêm ảnh mới vào album</label>
            <input type="file" name="album[]" multiple>

            <button type="submit">Cập nhật Album</button>
        </form>
    </div>

    <div style="text-align:center; margin-top:20px;">
        <a href="?action=tours">Quay lại</a>
    </div>
</body>
</html>