<?php
// Nhận dữ liệu
$tour = $tour ?? [];
$guests = $guests ?? [];

// Xuất file Excel
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=danh_sach_doan_" . $tour['id'] . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
        }

        th {
            background: #d9edf7;
        }

        h1 {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <h1>Danh sách đoàn – <?= htmlspecialchars($tour['ten_tour']) ?></h1>

    <table>
        <tr>
            <th>Họ tên</th>
            <th>SĐT</th>
            <th>Giới tính</th>
            <th>Năm sinh</th>
            <th>Yêu cầu đặc biệt</th>
        </tr>

        <?php foreach ($guests as $g): ?>
            <tr>
                <td><?= htmlspecialchars($g['ho_ten']) ?></td>
                <td><?= htmlspecialchars($g['sdt']) ?></td>
                <td><?= htmlspecialchars($g['gioi_tinh']) ?></td>
                <td><?= htmlspecialchars($g['nam_sinh']) ?></td>
                <td><?= htmlspecialchars($g['yeu_cau']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>

</html>
=======
=======
</table>