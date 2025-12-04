<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Sửa Tour</title>
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

        /* ===========================
           SIDEBAR CỐ ĐỊNH BÊN TRÁI
        ============================ */
        .sidebar {
            width: 220px;
            height: 100vh;
            background: #1e293b;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            z-index: 999;
        }

        .sidebar h2 {
            text-align: center;
            font-size: 20px;
            margin-bottom: 20px;
            color: #38bdf8;
        }

        .sidebar a {
            padding: 14px 20px;
            color: #cbd5e1;
            text-decoration: none;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: #334155;
            color: #fff;
        }


        /* ===========================
            NỘI DUNG – KHÔNG BAO GIỜ
            ẢNH HƯỞNG LÊN SIDEBAR
        ============================ */
        .content {
            margin-left: 220px;
            padding: 30px;
        }

        h1 {
            font-size: 26px;
            font-weight: 600;
            color: #1e293b;
            text-align: center;
            margin-top: 10px;
        }

        .container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .tour-form {
            width: 380px;
        }

        .album-form {
            width: 650px;
        }

        label {
            margin-top: 12px;
            display: block;
            font-weight: 600;
            color: #1e293b;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
        }

        button {
            margin-top: 18px;
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            background: #3b82f6;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        button:hover {
            background: #2563eb;
        }

        table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #e5e7eb;
            padding: 10px;
            text-align: center;
        }

        th {
            background: #3b82f6;
            color: #fff;
        }

        img {
            max-width: 120px;
            border-radius: 6px;
        }

        a.back-link {
            display: inline-block;
            padding: 10px 16px;
            background: #64748b;
            color: #fff;
            border-radius: 6px;
            margin-top: 25px;
            text-decoration: none;
        }

        a.back-link:hover {
            background: #475569;
        }
    </style>
</head>

<body>

    


    <!-- =========== CONTENT =========== -->
    <div class="content">

        <h1>Sửa Tour</h1>

        <div class="container">

            <!-- FORM SỬA TOUR -->
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
                    <img src="<?= htmlspecialchars((defined('BASE_ASSETS_UPLOADS') ? BASE_ASSETS_UPLOADS : 'assets/uploads/') . $tour['hinh_anh']) ?>">
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

                <button type="submit"><i class="fa fa-save"></i> Cập nhật Tour</button>
            </form>


            <!-- FORM ALBUM -->
            <form action="?action=tour_edit_post" method="post" enctype="multipart/form-data" class="album-form">
                <input type="hidden" name="id" value="<?= $tour['id'] ?>">

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

                <button type="submit"><i class="fa fa-save"></i> Cập nhật Album</button>
            </form>

        </div>

        <div style="text-align:center;">
            <a href="?action=tours" class="back-link"><i class="fa fa-arrow-left"></i> Quay lại</a>
        </div>
    </div>

</body>

</html>
