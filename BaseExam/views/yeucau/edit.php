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
    </div>

    <div class="content">
        <div class="top-bar">
            <h1>Sửa yêu cầu</h1>
            <a href="index.php?action=yeu_cau" class="btn"><i class="fa fa-arrow-left"></i> Quay về</a>
        </div>

        <?php if(!empty($_SESSION['flash_success'])): ?>
            <div class="flash-success"><?= $_SESSION['flash_success']; unset($_SESSION['flash_success']); ?></div>
        <?php endif; ?>

        <form action="index.php?action=yeu_cau_update&id=<?= $yeuCau['id'] ?>" method="POST">
            <input type="hidden" name="id" value="<?= $yeuCau['id'] ?>">

            <label>Tên khách:</label>
            <input type="text" name="ten_khach" value="<?= htmlspecialchars($yeuCau['ten_khach']) ?>" required>

            <label>Loại yêu cầu:</label>
            <select name="loai_yeu_cau">
                <option value="Ăn chay" <?= $yeuCau['loai_yeu_cau']=='Ăn chay'?'selected':'' ?>>Ăn chay</option>
                <option value="Yêu cầu về dị ứng" <?= $yeuCau['loai_yeu_cau']=='Yêu cầu về dị ứng'?'selected':'' ?>>Dị ứng</option>
                <option value="Yêu cầu về bệnh lý" <?= $yeuCau['loai_yeu_cau']=='Yêu cầu về bệnh lý'?'selected':'' ?>>Bệnh lý</option>
                <option value="Yêu cầu về phòng nghỉ" <?= $yeuCau['loai_yeu_cau']=='Yêu cầu về phòng nghỉ'?'selected':'' ?>>Phòng nghỉ</option>
                <option value="Yêu cầu phương tiện di chuyển" <?= $yeuCau['loai_yeu_cau']=='Yêu cầu phương tiện di chuyển'?'selected':'' ?>>Di chuyển</option>
                <option value="Yêu cầu về ăn uống" <?= $yeuCau['loai_yeu_cau']=='Yêu cầu về ăn uống'?'selected':'' ?>>Ăn uống</option>
                <option value="Khác" <?= $yeuCau['loai_yeu_cau']=='Khác'?'selected':'' ?>>Khác</option>
            </select>

            <label>Mô tả:</label>
            <textarea name="mo_ta" rows="4"><?= htmlspecialchars($yeuCau['mo_ta']) ?></textarea>

            <label>Trạng thái hiện tại:</label>
            <input type="hidden" name="trang_thai_cu" value="<?= $yeuCau['trang_thai'] ?? 'cho_xu_ly' ?>">
            <select name="trang_thai">
                <option value="cho_xu_ly" <?= ($yeuCau['trang_thai']=='cho_xu_ly')?'selected':'' ?>>Chờ xử lý</option>
                <option value="dang_xu_ly" <?= ($yeuCau['trang_thai']=='dang_xu_ly')?'selected':'' ?>>Đang xử lý</option>
                <option value="da_dap_ung" <?= ($yeuCau['trang_thai']=='da_dap_ung')?'selected':'' ?>>Đã đáp ứng</option>
                <option value="khong_the_dap_ung" <?= ($yeuCau['trang_thai']=='khong_the_dap_ung')?'selected':'' ?>>Không thể đáp ứng</option>
            </select>

            <button type="submit"><i class="fa fa-save"></i> Cập nhật</button>
        </form>

        <h3>Nhật ký xử lý</h3>
        <?php if(empty($logs)): ?>
            <p>Chưa có lịch sử xử lý.</p>
        <?php else: ?>
            <div style="border-left: 3px solid #3498db; padding-left: 20px; margin: 20px 0;">
                <?php foreach($logs as $index => $l): ?>
                    <div style="background: #f8f9fa; padding: 15px; margin-bottom: 15px; border-radius: 8px; position: relative;">
                        <div style="position: absolute; left: -30px; top: 15px; width: 12px; height: 12px; background: #3498db; border-radius: 50%; border: 3px solid #fff;"></div>
                        
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <strong style="color: #2c3e50;"><?= htmlspecialchars($l['nguoi_xu_ly']) ?></strong>
                            <small style="color: #7f8c8d;"><?= date('d/m/Y H:i', strtotime($l['created_at'])) ?></small>
                        </div>
                        
                        <p style="margin: 8px 0; color: #34495e;"><?= nl2br(htmlspecialchars($l['ghi_chu'])) ?></p>
                        
                        <?php if (!empty($l['trang_thai_cu']) && !empty($l['trang_thai_moi']) && $l['trang_thai_cu'] !== $l['trang_thai_moi']): ?>
                            <?php 
                            $trangThaiText = [
                                'cho_xu_ly' => 'Chờ xử lý',
                                'dang_xu_ly' => 'Đang xử lý', 
                                'da_dap_ung' => 'Đã đáp ứng',
                                'khong_the_dap_ung' => 'Không thể đáp ứng'
                            ];
                            $trangThaiColors = [
                                'cho_xu_ly' => '#f39c12',
                                'dang_xu_ly' => '#3498db', 
                                'da_dap_ung' => '#27ae60',
                                'khong_the_dap_ung' => '#e74c3c'
                            ];
                            ?>
                            <div style="margin-top: 10px;">
                                <span style="background: <?= $trangThaiColors[$l['trang_thai_cu']] ?? '#95a5a6' ?>; color: white; padding: 3px 8px; border-radius: 12px; font-size: 12px;">
                                    <?= $trangThaiText[$l['trang_thai_cu']] ?? $l['trang_thai_cu'] ?>
                                </span>
                                <i class="fa fa-arrow-right" style="margin: 0 8px; color: #7f8c8d;"></i>
                                <span style="background: <?= $trangThaiColors[$l['trang_thai_moi']] ?? '#95a5a6' ?>; color: white; padding: 3px 8px; border-radius: 12px; font-size: 12px;">
                                    <?= $trangThaiText[$l['trang_thai_moi']] ?? $l['trang_thai_moi'] ?>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>


    </div>
</body>

</html>