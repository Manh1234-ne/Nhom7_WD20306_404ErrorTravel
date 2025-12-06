<?php
// Các biến được truyền từ Controller:
// $_POST['ho_ten']
// $tour['ten_tour']
// $tour['id']
// $id  // ID khách sau khi insert
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đặt tour thành công</title>

    <style>
        body {
            background: #eef2f3;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 40px 0;
        }

        .success-box {
            max-width: 520px;
            padding: 30px;
            background: #ffffff;
            border-radius: 14px;
            border: 1px solid #e9e9e9;
            margin: auto;
            box-shadow: 0px 4px 18px rgba(0,0,0,0.08);
            animation: fadeIn 0.4s ease;
            text-align: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        h2 {
            color: #1a8f53;
            margin-top: 0;
            font-size: 26px;
            margin-bottom: 12px;
        }

<<<<<<< HEAD
        p {
            font-size: 17px;
            margin: 6px 0;
            color: #444;
        }

        .btn {
            padding: 10px 22px;
            text-decoration: none;
            border-radius: 6px;
            font-size: 15px;
            display: inline-block;
            margin: 10px 5px 0;
            font-weight: bold;
            transition: .25s;
        }

        .btn-view {
            background: linear-gradient(135deg, #28a745, #1e7d37);
            color: #fff;
            box-shadow: 0 3px 8px rgba(0, 128, 0, .25);
        }

        .btn-view:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 12px rgba(0, 128, 0, .35);
        }

        .btn-back {
            background: #555;
            color: #fff;
            box-shadow: 0 3px 8px rgba(0, 0, 0, .25);
        }

        .btn-back:hover {
            background: #3a3a3a;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>

<div class="success-box">
    <h2>Đặt tour thành công!</h2>

    <p>Khách: <strong><?= htmlspecialchars($_POST['ho_ten']) ?></strong></p>
    <p>Tour: <strong><?= htmlspecialchars($tour['ten_tour']) ?></strong></p>

    <br>

    <a href="?action=guest_detail&id=<?= $id ?>" class="btn btn-view">
        Xem chi tiết
    </a>

    <a href="?action=tour_guest&tour_id=<?= $tour['id'] ?>" class="btn btn-back">
        Quay lại danh sách khách
    </a>
</div>

</body>
</html>
=======
<a href="?action=tour_guest&tour_id=<?= $tour['id'] ?>" 
   style="padding: 10px 20px; background: #555; color: #fff; text-decoration:none;">
   Quay lại danh sách khách
<<<<<<< HEAD
</a>
=======
</a>
>>>>>>> 250280415b7ee3c16775e9d42957f5321c69aa17
>>>>>>> 4be59707c5392b49eb1dbbc2974463259f7e90f7
