<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm Nhân Sự</title>
    <style>
        body {
            font-family: Arial;
            background: #eef2f7;
            margin: 0;
            padding: 40px 0;
        }

        .container {
            width: 900px;
            margin: auto;
            background: #fff;
            border-radius: 12px;
            padding: 30px 40px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        h2 {
            text-align: center;
            color: #1f3f80;
            margin-bottom: 25px;
        }

        .form-2col {
            display: flex;
            gap: 25px;
        }

        .col {
            width: 50%;
        }

        .group {
            margin-bottom: 18px;
        }

        .group label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
        }

        .group input,
        .group select,
        .group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #cfd6e1;
            border-radius: 6px;
            font-size: 14px;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            margin-top: 15px;
            border-radius: 6px;
            background: #1a73e8;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background: #125ec6;
        }

        .back {
            text-align: center;
            margin-top: 15px;
        }

        .back a {
            color: #1a73e8;
            text-decoration: none;
        }

        .back a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function toggleHdvFields() {
            const role = document.querySelector('select[name="vai_tro"]').value;
            const hdvFields = document.querySelectorAll('.hdv-field');
            hdvFields.forEach(el => el.style.display = (role === 'Hướng dẫn viên') ? 'block' : 'none');
        }
    </script>
</head>

<body>

    <div class="container">
        <h2>Thêm Nhân Sự</h2>

        <form action="?action=nhansu_add_post" method="post">

            <div class="form-2col">

                <!-- CỘT TRÁI -->
                <div class="col">
                    <div class="group">
                        <label>Họ tên</label>
                        <input type="text" name="ho_ten" required>
                    </div>
                    <div class="group">
                        <label>Email</label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="group">
                        <label>Số điện thoại</label>
                        <input type="text" name="so_dien_thoai" required>
                    </div>
                    <div class="group">
                        <label>Vai trò</label>
                        <select name="vai_tro" onchange="toggleHdvFields()" required>
                            <option value="Hướng dẫn viên">Hướng dẫn viên</option>
                            <option value="Admin">Admin</option>
                            <option value="Khách hàng">Khách hàng</option>
                        </select>
                    </div>
                </div>

                <!-- CỘT PHẢI -->
                <div class="col">
                    <div class="group hdv-field">
                        <label>Ngôn ngữ</label>
                        <input type="text" name="ngon_ngu">
                    </div>
                    <div class="group hdv-field">
                        <label>Kinh nghiệm</label>
                        <textarea name="kinh_nghiem" rows="5"></textarea>
                    </div>
                    <div class="group hdv-field">
                        <label>Đánh giá</label>
                        <input type="number" name="danh_gia" min="0" max="5" step="0.1" value="0">
                    </div>
                </div>

            </div>

            <button class="btn" type="submit">Thêm mới</button>
        </form>

        <div class="back">
            <a href="?action=nhansu">Quay lại danh sách</a>
        </div>
    </div>

    <script>
        toggleHdvFields();
    </script>
</body>

</html>