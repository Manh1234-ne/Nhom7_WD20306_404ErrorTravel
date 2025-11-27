<h2>Danh sách khách – Tour: <?= $tour['ten_tour'] ?></h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Họ tên</th>
        <th>SĐT</th>
        <th>Giới tính</th>
        <th>Năm sinh</th>
        <th>Yêu cầu</th>
        <th>Check-in</th>
        <th>Phòng</th>
    </tr>

    <?php foreach ($guests as $g): ?>
    <tr>
        <td><?= $g['ho_ten'] ?></td>
        <td><?= $g['sdt'] ?></td>
        <td><?= $g['gioi_tinh'] ?></td>
        <td><?= $g['nam_sinh'] ?></td>
        <td><?= $g['yeu_cau'] ?></td>

        <td>
            <form method="post" action="?action=tour_guest_checkin">
                <input type="hidden" name="id" value="<?= $g['id'] ?>">
                <input type="hidden" name="tour_id" value="<?= $tour['id'] ?>">
                <select name="trang_thai" onchange="this.form.submit()">
                    <option value="chua_den" <?= $g['trang_thai']=='chua_den'?'selected':'' ?>>Chưa đến</option>
                    <option value="da_den" <?= $g['trang_thai']=='da_den'?'selected':'' ?>>Đã đến</option>
                    <option value="vang_mat" <?= $g['trang_thai']=='vang_mat'?'selected':'' ?>>Vắng mặt</option>
                </select>
            </form>
        </td>

        <td>
            <form method="post" action="?action=tour_guest_room">
                <input type="hidden" name="id" value="<?= $g['id'] ?>">
                <input type="hidden" name="tour_id" value="<?= $tour['id'] ?>">
                <input type="text" name="phong" value="<?= $g['phong'] ?>" onchange="this.form.submit()">
            </form>
        </td>

    </tr>
    <?php endforeach; ?>
</table>

<br>

<a href="?action=tour_guest_export&tour_id=<?= $tour['id'] ?>">In danh sách đoàn</a>