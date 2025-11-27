<h1>Danh sách đoàn – <?= $tour['ten_tour'] ?></h1>

<table border ="1" cellpadding="10" width="100%">
    <tr>
        <th>Họ tên</th>
        <th>SĐT</th>
        <th>Giới tính</th>
        <th>Năm sinh</th>
        <th>Yêu cầu đặc biệt</th>
    </tr>

    <?php foreach ($guests as $g): ?>
    <tr>
        <td><?= $g['ho_ten'] ?></td>
        <td><?= $g['sdt'] ?></td>
        <td><?= $g['gioi_tinh'] ?></td>
        <td><?= $g['nam_sinh'] ?></td>
        <td><?= $g['yeu_cau'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>
