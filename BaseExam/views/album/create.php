<?php
// views/albums/create.php
?>
<h2>Tạo album</h2>
<form action="index.php?controller=albums&action=store" method="post" enctype="multipart/form-data">
    <div>
        <label>Tiêu đề</label><br>
        <input type="text" name="title" required>
    </div>
    <div>
        <label>Mô tả</label><br>
        <textarea name="description"></textarea>
    </div>
    <div>
        <label>Upload ảnh (chọn nhiều)</label><br>
        <input type="file" name="images[]" accept="image/*" multiple>
    </div>
    <div>
        <button type="submit">Tạo</button>
    </div>
</form>