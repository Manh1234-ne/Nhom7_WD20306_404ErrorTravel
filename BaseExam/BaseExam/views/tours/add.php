<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm Tour</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f0f2f5;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
        }

        input,
        select,
        textarea {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            margin-top: 15px;
            padding: 10px;
            background: #3498db;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        a {
            margin-top: 10px;
            text-decoration: none;
            color: #3498db;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Thêm Tour</h1>
        <form action="?action=tour_add_post" method="post" enctype="multipart/form-data">
            <label>Tên Tour</label>
            <input type="text" name="ten_tour" required>

            <label>Loại Tour</label>
            <select name="loai_tour" required>
                <option value="" disabled selected>Chọn loại tour</option>
                <?php foreach ($loaiTours as $loai): ?>
                    <option value="<?= $loai ?>"><?= $loai ?></option>
                <?php endforeach; ?>
            </select>


            <label>Giá</label>
            <input type="number" name="gia" required>

            <label>Mô tả</label>
            <textarea name="mo_ta" rows="3"></textarea>

            <label>Chính sách</label>
            <textarea name="chinh_sach" rows="3"></textarea>

            <label>Hình ảnh</label>
            <input type="file" name="hinh_anh">

            <button type="submit">Thêm Tour</button>
        </form>
        <a href="?action=tours">Quay lại</a>
    </div>
</body>

</html>