<!-- views/yeu_cau/edit.php -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Sửa yêu cầu</title>
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
            margin-bottom: 30px;
        }

        form label {
            font-weight: bold;
        }

        form input[type="text"],
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

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #3498db;
            color: #fff;
        }

        .flash-success {
            color: green;
            margin-bottom: 15px;
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
        <a href="?action=tours"><i class="fa fa-list"></i> Chi tiết tour</a>

    </div>

    <div class="content">
        <div class="top-bar">
            <h1>Sửa yêu cầu</h1>
            <a href="index.php?action=yeu_cau" class="btn"><i class="fa fa-arrow-left"></i> Quay về</a>
        </div>

        <?php if(!empty($_SESSION['flash_success'])): ?>
            <div class="flash-success"><?= $_SESSION['flash_success']; unset($_SESSION['flash_success']); ?></div>
        <?php endif; ?>

        <form action="index.php?action=yeu_cau_update" method="POST">
            <input type="hidden" name="id" value="<?= $yeuCau['id'] ?>">

            <label>Tên khách:</label>
            <input type="text" name="ten_khach" value="<?= htmlspecialchars($yeuCau['ten_khach']) ?>" required>

            <label>Loại yêu cầu:</label>
            <select name="loai_yeu_cau">
                <?php
                $types = ['an_chay','di_ung','benh_ly','yeu_cau_phong','yeu_cau_di_chuyen','yeu_cau_an_uong','khac'];
                foreach ($types as $t): ?>
                    <option value="<?= $t ?>" <?= $yeuCau['loai_yeu_cau']==$t?'selected':'' ?>><?= $t ?></option>
                <?php endforeach; ?>
            </select>

            <label>Mô tả:</label>
            <textarea name="mo_ta" rows="4"><?= htmlspecialchars($yeuCau['mo_ta']) ?></textarea>

            <label>Trạng thái hiện tại:</label>
            <input type="hidden" name="trang_thai_cu" value="<?= $yeuCau['trang_thai'] ?>">
            <select name="trang_thai">
                <option value="Chờ xử lý" <?= ($yeuCau['trang_thai']=='Chờ xử lý')?'selected':'' ?>>Chờ xử lý</option>
                <option value="Đang xử lý" <?= ($yeuCau['trang_thai']=='Đang xử lý')?'selected':'' ?>>Đang xử lý</option>
                <option value="Đã đáp ứng" <?= ($yeuCau['trang_thai']=='Đã đáp ứng')?'selected':'' ?>>Đã đáp ứng</option>
                <option value="Không thể đáp ứng" <?= ($yeuCau['trang_thai']=='Không thể đáp ứng')?'selected':'' ?>>Không thể đáp ứng</option>
            </select>

            <button type="submit"><i class="fa fa-save"></i> Cập nhật</button>
        </form>

        <h3>Nhật ký xử lý</h3>
        <?php if(empty($logs)): ?>
            <p>Chưa có nhật ký xử lý.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Thời gian</th>
                        <th>Người xử lý</th>
                        <th>Ghi chú</th>
                        <th>Trạng thái cũ</th>
                        <th>Trạng thái mới</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($logs as $l): ?>
                        <tr>
                            <td><?= $l['created_at'] ?></td>
                            <td><?= htmlspecialchars($l['nguoi_xu_ly']) ?></td>
                            <td><?= nl2br(htmlspecialchars($l['ghi_chu'])) ?></td>
                            <td><?= htmlspecialchars($l['trang_thai_cu']) ?></td>
                            <td><?= htmlspecialchars($l['trang_thai_moi']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <h3>Thêm nhật ký xử lý</h3>
        <form action="index.php?action=yeu_cau_luu_nhat_ky" method="POST">
            <input type="hidden" name="id_yeu_cau" value="<?= $yeuCau['id'] ?>">
            <input type="hidden" name="trang_thai_cu" value="<?= $yeuCau['trang_thai'] ?>">

            <label>Ghi chú:</label>
            <textarea name="ghi_chu" rows="4" required></textarea>

            <label>Trạng thái mới (nếu có):</label>
            <select name="trang_thai_moi">
                <option value="">(Không thay đổi)</option>
                <option value="Chờ xử lý">Chờ xử lý</option>
                <option value="Đang xử lý">Đang xử lý</option>
                <option value="Đã đáp ứng">Đã đáp ứng</option>
                <option value="Không thể đáp ứng">Không thể đáp ứng</option>
            </select>

            <button type="submit"><i class="fa fa-plus"></i> Lưu nhật ký</button>
        </form>
    </div>
</body>

</html>