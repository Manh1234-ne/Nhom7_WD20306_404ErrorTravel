<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm Danh mục Tour</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #eef2f7;
            padding: 50px 0;
        }

        .container {
            width: 1100px; /* FULL GIỐNG TRANG TOUR */
            margin: auto;
            background: #fff;
            padding: 40px 60px;
            border-radius: 14px;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #1f3f80;
            margin-bottom: 35px;
            font-size: 30px;
        }

        label {
            font-weight: bold;
            display: block;
            margin: 18px 0 6px;
            font-size: 15px;
        }

        input,
        textarea {
            width: 100%; /* DÀI FULL */
            padding: 12px;
            border: 1px solid #cfd6e1;
            border-radius: 8px;
            background: white;
            font-size: 15px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            height: 180px; /* CAO GIỐNG FORM TOUR */
        }

        .btn {
            margin-top: 30px;
            width: 100%;
            padding: 14px;
            border-radius: 8px;
            border: none;
            background: #1a73e8;
            font-size: 17px;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
        }

        .btn:hover {
            background: #1664c4;
        }

        .back {
            margin-top: 22px;
            text-align: center;
        }

        .back a {
            color: #1a73e8;
            text-decoration: none;
            font-size: 15px;
        }

        .back a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>Thêm Danh mục Tour</h1>

        <form action="?action=danhmuc_add_post" method="post">

            <label>Tên danh mục Tour</label>
            <input type="text" name="ten_tour" required>

            <label>Mô tả</label>
            <textarea name="mo_ta"></textarea>

            <button class="btn" type="submit">Thêm Danh mục</button>
        </form>

        <div class="back">
            <a href="?action=danhmuc">← Quay lại danh sách</a>
        </div>

    </div>

</body>

</html>