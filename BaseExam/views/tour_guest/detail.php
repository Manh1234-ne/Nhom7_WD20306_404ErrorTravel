<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết khách</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 30px;
        }

        .card {
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            width: 600px;
            margin: auto;
            box-shadow: 0 2px 7px rgba(0,0,0,0.1);
        }

        h2 {
            margin-top: 0;
            color: #2c3e50;
        }

<<<<<<< HEAD
        p {
            font-size: 16px;
            margin: 8px 0;
        }

        strong {
            color: #333;
        }

        a.back-btn {
            display: inline-block;
            margin-top: 18px;
            padding: 10px 18px;
            background: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        a.back-btn:hover {
            background: #2980b9;
        }
    </style>
</head>

<body>
<div class="card">

    <h2>Chi tiết khách</h2>

    <p><strong>Họ tên:</strong> <?= htmlspecialchars($guest['ho_ten']) ?></p>
    <p><strong>SĐT:</strong> <?= htmlspecialchars($guest['sdt']) ?></p>
    <p><strong>Giới tính:</strong> <?= htmlspecialchars($guest['gioi_tinh']) ?></p>
    <p><strong>Năm sinh:</strong> <?= htmlspecialchars($guest['nam_sinh']) ?></p>
    <p><strong>Yêu cầu đặc biệt:</strong> <?= htmlspecialchars($guest['yeu_cau']) ?></p>

    <h3>Thông tin tour</h3>
    <p><strong>Tour:</strong> <?= htmlspecialchars($tour['ten_tour']) ?></p>

    <br>

    <a href="?action=tour_guest&tour_id=<?= $tour['id'] ?>" class="back-btn">
        ← Quay lại danh sách khách
    </a>

</div>
</body>
</html>
=======
<br>
<a href="?action=tour_guest&tour_id=<?= $tour['id'] ?>"
   style="padding: 8px 16px; background:#444; color:#fff; text-decoration:none;">
   Quay lại danh sách khách
<<<<<<< HEAD
</a>
=======
</a>
>>>>>>> 250280415b7ee3c16775e9d42957f5321c69aa17
>>>>>>> 4be59707c5392b49eb1dbbc2974463259f7e90f7
