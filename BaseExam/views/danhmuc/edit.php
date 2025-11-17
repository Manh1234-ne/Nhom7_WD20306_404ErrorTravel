<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Sửa danh mục tour</title>
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

        img {
            margin-top: 10px;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Sửa danh mục Tour</h1>
        <form action="?action=danhmuc_edit_post" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $danhmuc['id'] ?>">

            <label>Tên danh mục Tour</label>
            <input type="text" name="ten_tour" value="<?= htmlspecialchars($danhmuc['ten_tour']) ?>" required>

            <label>Mô tả</label>
            <textarea name="mo_ta" rows="3"><?= htmlspecialchars($danhmuc['mo_ta']) ?></textarea>

            <button type="submit">Cập nhật Tour</button>
        </form>
        <a href="?action=danhmuc">Quay lại</a>
    </div>
</body>

</html>