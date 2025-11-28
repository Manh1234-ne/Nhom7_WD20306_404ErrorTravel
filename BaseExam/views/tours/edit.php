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
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .tour-form {
            width: 350px;
        }

        .album-form {
            width: 500px;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
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

        <!-- Form Sửa Tour -->
        <form action="?action=tour_edit_post" method="post" enctype="multipart/form-data" class="tour-form">
            <input type="hidden" name="id" value="<?= $tour['id'] ?>">
            <h2>Thông tin Tour</h2>

            <label>Tên Tour</label>
            <input type="text" name="ten_tour" value="<?= htmlspecialchars($tour['ten_tour']) ?>" required>

            <label>Loại Tour</label>
            <select name="loai_tour">
                <option value="Trong nước" <?= $tour['loai_tour'] == 'Trong nước' ? 'selected' : '' ?>>Trong nước</option>
                <option value="Quốc tế" <?= $tour['loai_tour'] == 'Quốc tế' ? 'selected' : '' ?>>Quốc tế</option>
                <option value="Theo yêu cầu" <?= $tour['loai_tour'] == 'Theo yêu cầu' ? 'selected' : '' ?>>Theo yêu cầu</option>
            </select>

            <label>Mô tả</label>
            <textarea name="mo_ta"><?= htmlspecialchars($tour['mo_ta']) ?></textarea>

            <label>Giá</label>
            <input type="number" name="gia" value="<?= $tour['gia'] ?>">

            <label>Chính sách</label>
            <textarea name="chinh_sach"><?= htmlspecialchars($tour['chinh_sach']) ?></textarea>

            <label>Hình ảnh hiện tại</label>
            <?php if (!empty($tour['hinh_anh'])): ?>
                <img src="<?= htmlspecialchars((defined('BASE_ASSETS_UPLOADS') ? BASE_ASSETS_UPLOADS : 'assets/uploads/') . $tour['hinh_anh']) ?>" width="120">
            <?php endif; ?>

            <label>Thay đổi hình ảnh</label>
            <input type="file" name="hinh_anh">

            <label>Nhà cung cấp</label>
            <select name="nha_cung_cap">
                <option value="VietTravel" <?= ($tour['nha_cung_cap'] ?? '') == 'VietTravel' ? 'selected' : '' ?>>VietTravel</option>
                <option value="Saigontourist" <?= ($tour['nha_cung_cap'] ?? '') == 'Saigontourist' ? 'selected' : '' ?>>Saigontourist</option>
                <option value="BestTrip" <?= ($tour['nha_cung_cap'] ?? '') == 'BestTrip' ? 'selected' : '' ?>>BestTrip</option>
                <option value="Fiditour" <?= ($tour['nha_cung_cap'] ?? '') == 'Fiditour' ? 'selected' : '' ?>>Fiditour</option>
                <option value="Khác" <?= ($tour['nha_cung_cap'] ?? '') == 'Khác' ? 'selected' : '' ?>>Khác</option>
            </select>

            <label>Mùa</label>
            <select name="mua">
                <option value="Mùa Xuân" <?= ($tour['mua'] ?? '') == 'Mùa Xuân' ? 'selected' : '' ?>>Mùa Xuân</option>
                <option value="Mùa Hạ" <?= ($tour['mua'] ?? '') == 'Mùa Hạ' ? 'selected' : '' ?>>Mùa Hạ</option>
                <option value="Mùa Thu" <?= ($tour['mua'] ?? '') == 'Mùa Thu' ? 'selected' : '' ?>>Mùa Thu</option>
                <option value="Mùa Đông" <?= ($tour['mua'] ?? '') == 'Mùa Đông' ? 'selected' : '' ?>>Mùa Đông</option>
            </select>

            <button type="submit">Cập nhật Tour</button>
        </form>

        <!-- Form Album -->
        <form action="?action=tour_edit_post" method="post" enctype="multipart/form-data" class="album-form">
            <input type="hidden" name="id" value="<?= htmlspecialchars($tour['id']) ?>">
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
                                <td>
                                    <img src="<?= htmlspecialchars((defined('BASE_ASSETS_UPLOADS') ? BASE_ASSETS_UPLOADS : 'assets/uploads/') . $img->file_name) ?>">
                                </td>
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
