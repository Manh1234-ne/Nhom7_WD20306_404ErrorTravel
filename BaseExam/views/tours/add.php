<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm Tour</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #eef2f7;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background: #1e293b;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            color: #fff;
            padding-top: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
        }

        .sidebar h2 {
            font-size: 20px;
            text-align: center;
            margin-bottom: 25px;
            color: #38bdf8;
            font-weight: 600;
        }

        .sidebar a {
            padding: 14px 20px;
            color: #cbd5e1;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: 0.25s;
            font-size: 15px;
        }

        .sidebar a:hover {
            background: #334155;
            color: #fff;
        }

        .sidebar i {
            margin-right: 12px;
        }

        /* CONTENT */
        .content {
            margin-left: 250px;
            padding: 40px 35px;
        }

        h1 {
            margin-bottom: 25px;
            font-size: 28px;
            font-weight: 600;
            color: #1e293b;
        }

        /* FORM */
        form {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 950px;
        }

        /* GRID 2 CỘT */
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        label {
            font-weight: 600;
            margin-top: 12px;
            display: block;
            color: #334155;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            font-size: 15px;
            background: #f8fafc;
        }

        textarea {
            height: 110px;
        }

        .full-row {
            grid-column: span 2;
        }

        button {
            margin-top: 25px;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            background: #3b82f6;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }

        button:hover {
            background: #2563eb;
        }

        a.back {
            display: inline-block;
            margin-top: 18px;
            color: #3b82f6;
            font-weight: 600;
            text-decoration: none;
        }
    </style>
</head>

<body>

    
    <!-- CONTENT -->
    <div class="content">
        <h1>Thêm Tour</h1>

        <form action="?action=tour_add_post" method="post" enctype="multipart/form-data">

            <div class="grid-2">

                <!-- CỘT TRÁI -->
                <div>
                    <label>Tên Tour</label>
                    <input type="text" name="ten_tour" required>

                    <label>Loại Tour</label>
                    <select name="loai_tour">
                        <option value="Trong nước">Trong nước</option>
                        <option value="Quốc tế">Quốc tế</option>
                        <option value="Theo yêu cầu">Theo yêu cầu</option>
                    </select>

                    <label>Giá</label>
                    <input type="number" name="gia">

                    <label>Mùa</label>
                    <select name="mua">
                        <option value="">Chọn Mùa</option>
                        <option value="Mùa Xuân">Mùa Xuân</option>
                        <option value="Mùa Hạ">Mùa Hạ</option>
                        <option value="Mùa Thu">Mùa Thu</option>
                        <option value="Mùa Đông">Mùa Đông</option>
                    </select>
                </div>

                <!-- CỘT PHẢI -->
                <div>
                    <label>Nhà Cung Cấp</label>
                    <select name="nha_cung_cap">
                        <option value="">Chọn Nhà Cung Cấp</option>
                        <option value="VietTravel">VietTravel</option>
                        <option value="Saigontourist">Saigontourist</option>
                        <option value="BestTrip">BestTrip</option>
                        <option value="Fiditour">Fiditour</option>
                        <option value="Khác">Khác</option>
                    </select>

                    <label>Hình ảnh đại diện</label>
                    <input type="file" name="hinh_anh">

                    <label>Album ảnh</label>
                    <input type="file" name="album[]" multiple>
                </div>

                <!-- DÒNG FULL -->
                <div class="full-row">
                    <label>Mô tả</label>
                    <textarea name="mo_ta"></textarea>
                </div>

                <div class="full-row">
                    <label>Chính sách</label>
                    <textarea name="chinh_sach"></textarea>
                </div>

            </div>

            <button type="submit">Thêm Tour</button>
            <a class="back" href="?action=tours">← Quay lại</a>

        </form>
    </div>

</body>

</html>
