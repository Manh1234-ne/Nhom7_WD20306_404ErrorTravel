<!-- views/yeu_cau/create.php -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm yêu cầu đặc biệt</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        .sidebar {
            width: 220px;
            background: #2c3e50;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
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
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>404 Error Travel</h2>
        <a href="?action=home"><i class="fa fa-home"></i>Trang chủ</a>
        <a href="?action=tours"><i class="fa fa-suitcase"></i>Quản lý tour</a>
        <a href="?action=nhansu"><i class="fa fa-user-tie"></i>Quản lý nhân sự</a>
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