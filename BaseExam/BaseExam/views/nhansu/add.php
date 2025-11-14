<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm Hướng dẫn viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
        textarea {
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
    <h2>Thêm Hướng Dẫn Viên</h2>

    <form action="?action=nhansu_add_post" method="post">
        <div>
            <label>Họ tên:</label>
            <input type="text" name="ho_ten" required>
        </div>

        <div>
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>

        <div>
            <label>Số điện thoại:</label>
            <input type="text" name="so_dien_thoai" required>
        </div>

        <div>
            <label>Ngôn ngữ:</label>
            <input type="text" name="ngon_ngu" required>
        </div>

        <div>
            <label>Kinh nghiệm:</label>
            <textarea name="kinh_nghiem" rows="4"></textarea>
        </div>

        <div>
            <label>Đánh giá:</label>
            <input type="number" name="danh_gia" min="0" max="5" step="0.1" value="0">
        </div>

        <div>
            <button type="submit">Thêm mới</button>
        </div>
    </form>
</body>

</html>
