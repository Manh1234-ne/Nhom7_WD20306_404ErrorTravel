<!-- views/yeu_cau/create.php -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm yêu cầu đặc biệt</title>
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

        /* ==== SIDEBAR ==== */
        .sidebar {
            width: 250px;
            background: #1e293b;
            color: white;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
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
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>404 Error Travel</h2>
        <a href="?action=home"><i class="fa fa-home"></i>Trang chủ</a>
        <a href="?action=tours"><i class="fa fa-suitcase"></i>Quản lý tour</a>
        <a href="?action=nhansu"><i class="fa fa-user-tie"></i>Quản lý nhân sự</a>
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