<h2>Chi tiết khách</h2>

<p><strong>Họ tên:</strong> <?= $guest['ho_ten'] ?></p>
<p><strong>SĐT:</strong> <?= $guest['sdt'] ?></p>
<p><strong>Giới tính:</strong> <?= $guest['gioi_tinh'] ?></p>
<p><strong>Năm sinh:</strong> <?= $guest['nam_sinh'] ?></p>
<p><strong>Yêu cầu:</strong> <?= $guest['yeu_cau'] ?></p>

<h3>Thông tin tour</h3>
<p><strong>Tour:</strong> <?= $tour['ten_tour'] ?></p>

<br>
<a href="?action=tour_guest&tour_id=<?= $tour['id'] ?>"
   style="padding: 8px 16px; background:#444; color:#fff; text-decoration:none;">
   Quay lại danh sách khách
</a>
