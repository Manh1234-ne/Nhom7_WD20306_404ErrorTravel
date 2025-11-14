<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Sửa Tour</title>
<style>
body {margin:0;font-family:Arial,sans-serif;background:#f0f2f5;}
.container {width:50%;margin:50px auto;background:#fff;padding:20px;box-shadow:0 0 10px rgba(0,0,0,0.1);}
h1 {text-align:center;color:#333;}
form {display:flex;flex-direction:column;}
label {margin:10px 0 5px;}
input, select {padding:8px;border:1px solid #ccc;border-radius:4px;}
button {margin-top:15px;padding:10px;background:#3498db;color:#fff;border:none;border-radius:4px;cursor:pointer;}
a {margin-top:10px;text-decoration:none;color:#3498db;}
img {margin-top:10px;border-radius:4px;}
</style>
</head>
<body>
<div class="container">
<h1>Sửa Tour</h1>
<form action="?action=tour_edit_post" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?= $tour['id'] ?>">

<label>Tên Tour</label>
<input type="text" name="ten_tour" value="<?= $tour['ten_tour'] ?>" required>

<label>Loại Tour</label>
<input type="text" name="loai_tour" value="<?= $tour['loai_tour'] ?>" required>

<label>Giá</label>
<input type="number" name="gia" value="<?= $tour['gia'] ?>" required>

<label>Hình ảnh hiện tại</label>
<?php if($tour['hinh_anh']): ?>
<img src="<?= BASE_ASSETS_UPLOADS.$tour['hinh_anh'] ?>" width="120">
<?php endif; ?>

<label>Thay đổi hình ảnh</label>
<input type="file" name="hinh_anh">

<button type="submit">Cập nhật Tour</button>
</form>
<a href="?action=tours">Quay lại</a>
</div>
</body>
</html>
