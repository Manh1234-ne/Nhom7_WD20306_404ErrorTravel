<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm Tour</title>
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
    <h1>Thêm Tour</h1>

    <form action="?action=tour_add_post" method="post" enctype="multipart/form-data">

        <label>Tên Tour</label>
        <input type="text" name="ten_tour" required>

        <label>Loại Tour</label>
        <select name="loai_tour">
            <option value="Trong nước">Trong nước</option>
            <option value="Quốc tế">Quốc tế</option>
            <option value="Theo yêu cầu">Yêu cầu</option>
        </select>

        <label>Mô tả</label>
        <textarea name="mo_ta"></textarea>

        <label>Hướng dẫn viên</label>
        <select name="nhan_su_id">
            <?php foreach ($hdvList as $hdv): ?>
                <option value="<?= $hdv['id'] ?>">
                    <?= $hdv['ho_ten'] ?> (<?= $hdv['email'] ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <label>Giá</label>
        <input type="number" name="gia">

        <label>Chính sách</label>
        <textarea name="chinh_sach"></textarea>

        <label>Hình ảnh đại diện</label>
        <input type="file" name="hinh_anh">

        <h3>Nhà cung cấp</h3>
        <textarea name="nha_cung_cap"></textarea>

        <label>Mùa</label>
        <select name="mua">
            <option value="mua_xuan">Mùa Xuân</option>
            <option value="mua_ha">Mùa Hạ</option>
            <option value="mua_thu">Mùa Thu</option>
            <option value="mua_dong">Mùa Đông</option>
        </select>

        <label>Album ảnh (có thể chọn nhiều)</label>
        <input type="file" name="album[]" multiple>

        <button type="submit">Thêm Tour</button>
        <a href="?action=tours">Quay lại</a>
    </form>

</body>

</html>