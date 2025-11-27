<h2>Đặt tour thành công!</h2>

<p>Khách: <strong><?= $_POST['ho_ten'] ?></strong></p>
<p>Tour: <strong><?= $tour['ten_tour'] ?></strong></p>

<br>

<a href="?action=guest_detail&id=<?= $id ?>" 
   style="padding: 10px 20px; background: green; color: #fff; text-decoration:none;">
   Xem chi tiết
</a>

&nbsp;

<a href="?action=tour_guest&tour_id=<?= $tour['id'] ?>" 
   style="padding: 10px 20px; background: #555; color: #fff; text-decoration:none;">
   Quay lại danh sách khách
</a>