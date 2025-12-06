<!-- views/yeu_cau/create.php -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm yêu cầu đặc biệt</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<<<<<<< HEAD

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #eef2f7;
        }

        /* ==== SIDEBAR ==== */
        .sidebar {
            width: 250px;
            background: #1e293b;
            color: white;
=======
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        .sidebar {
            width: 220px;
            background: #2c3e50;
>>>>>>> lebang271206-ui
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
<<<<<<< HEAD
            padding-top: 20px;
        }

        .sidebar h2 {
            font-size: 20px;
            text-align: center;
            margin-bottom: 25px;
            color: #38bdf8;
        }

        .sidebar a {
            padding: 14px 20px;
            display: flex;
            align-items: center;
            color: #cbd5e1;
            text-decoration: none;
            transition: 0.25s;
        }

        .sidebar a:hover {
            background: #334155;
            color: #fff;
        }

        .sidebar i {
            margin-right: 12px;
        }

        /* ==== CONTENT ==== */
        .content {
            margin-left: 250px;
            padding: 40px 35px;
        }

        h1 {
            margin-top: 0;
            font-size: 28px;
            font-weight: 600;
            color: #1e293b;
=======
            color: #fff;
            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #34495e;
        }

        .sidebar a {
            padding: 15px 20px;
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .sidebar a:hover {
            background: #34495e;
        }

        .sidebar i {
            margin-right: 10px;
        }

        .content {
            margin-left: 220px;
            padding: 30px;
>>>>>>> lebang271206-ui
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
<<<<<<< HEAD
            margin-bottom: 25px;
        }

        a.btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #3b82f6;
            color: #fff;
            padding: 10px 14px;
            border-radius: 8px;
            text-decoration: none;
        }

        a.btn-back:hover {
            background: #2563eb;
        }

        /* ==== FORM CARD ==== */
        .form-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            max-width: 900px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        label {
            font-weight: 600;
            margin-bottom: 6px;
            display: block;
            color: #374151;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            background: #f8fafc;
            font-size: 15px;
        }

        textarea {
            resize: vertical;
        }

        /* ==== BUTTONS ==== */
        .btn-submit {
            background: #10b981;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
        }

        .btn-submit:hover {
            background: #059669;
        }

        .btn-cancel {
            background: #ef4444;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            margin-left: 10px;
        }

        .btn-cancel:hover {
            background: #b91c1c;
=======
            margin-bottom: 20px;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        form label {
            font-weight: bold;
        }

        form input[type="text"],
        form input[type="number"],
        form select,
        form textarea {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form button,
        a.btn {
            padding: 6px 12px;
            background: #3498db;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            margin-right: 5px;
        }

        form button:hover,
        a.btn:hover {
            background: #2980b9;
        }

        @media(max-width:768px) {
            .sidebar {
                width: 100%;
                height: auto;
                flex-direction: row;
                overflow-x: auto;
            }

            .sidebar h2 {
                display: none;
            }

            .sidebar a {
                flex: 1;
                justify-content: center;
            }

            .content {
                margin-left: 0;
                padding: 20px;
            }
>>>>>>> lebang271206-ui
        }
    </style>
</head>

<body>
<<<<<<< HEAD

    <!-- SIDEBAR -->
=======
>>>>>>> lebang271206-ui
    <div class="sidebar">
        <h2>404 Error Travel</h2>
        <a href="?action=home"><i class="fa fa-home"></i>Trang chủ</a>
        <a href="?action=tours"><i class="fa fa-suitcase"></i>Quản lý tour</a>
        <a href="?action=nhansu"><i class="fa fa-user-tie"></i>Quản lý nhân sự</a>
<<<<<<< HEAD
        <a href="?action=danhmuc"><i class="fa fa-th"></i>Quản lý danh mục</a>
        <a href="?action=qlbooking"><i class="fa fa-ticket"></i>Quản lý booking</a>
        <a href="?action=yeu_cau"><i class="fa fa-star"></i>Yêu cầu đặc biệt</a>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <div class="top-bar">
            <h1>Thêm yêu cầu đặc biệt</h1>
            <a href="?action=yeu_cau" class="btn-back">
                <i class="fa fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <div class="form-card">
            <form action="?action=yeu_cau_store" method="POST">

                <div class="form-row">
                    <div>
                        <label>Tên khách</label>
                        <input type="text" name="ten_khach" required>
                    </div>

                    <div>
                        <label>Loại yêu cầu</label>
                        <select name="loai_yeu_cau" required>
                            <option value="">-- Chọn yêu cầu --</option>
                            <option value="Ăn chay">Ăn chay</option>
                            <option value="Yêu cầu về dị ứng">Dị ứng</option>
                            <option value="Yêu cầu về bệnh lý">Bệnh lý</option>
                            <option value="Yêu cầu về phòng nghỉ">Phòng nghỉ</option>
                            <option value="Yêu cầu phương tiện di chuyển">Di chuyển</option>
                            <option value="Yêu cầu về ăn uống">Ăn uống</option>
                            <option value="Khác">Khác</option>
                        </select>
                    </div>
                </div>

                <label>Mô tả chi tiết</label>
                <textarea name="mo_ta" rows="5"></textarea>

                <button type="submit" class="btn-submit">Lưu yêu cầu</button>
                <a href="?action=yeu_cau" class="btn-cancel">Hủy</a>
            </form>
        </div>

    </div>

</body>

</html>
=======
        <a href="?action=yeu_cau"><i class="fa fa-star"></i>Yêu cầu đặc biệt</a>
    </div>

    <div class="content">
        <div class="top-bar">
            <h1>Thêm yêu cầu đặc biệt</h1>
            <a href="index.php?action=yeu_cau" class="btn"><i class="fa fa-arrow-left"></i> Quay về</a>
        </div>

        <form action="index.php?action=yeu_cau_store" method="POST">
            <!-- <label>ID Booking / Tour:</label>
            <input type="number" name="id_booking" min="1" required> -->

            <label>Tên khách:</label>
            <input type="text" name="ten_khach" required>

            <label>Loại yêu cầu:</label>
            <select name="loai_yeu_cau" required>
                <option value="">-- Chọn loại yêu cầu --</option>
                <option value="an_chay">Ăn chay</option>
                <option value="di_ung">Dị ứng</option>
                <option value="benh_ly">Bệnh lý</option>
                <option value="yeu_cau_phong">Phòng nghỉ</option>
                <option value="yeu_cau_di_chuyen">Di chuyển</option>
                <option value="yeu_cau_an_uong">Ăn uống</option>
                <option value="khac">Khác</option>
            </select>

            <label>Mô tả chi tiết:</label>
            <textarea name="mo_ta" rows="5"></textarea>

            <button type="submit">Lưu yêu cầu</button>
            <a href="index.php?action=yeu_cau" class="btn">Hủy</a>
        </form>

    </div>
</body>

</html>
>>>>>>> lebang271206-ui
