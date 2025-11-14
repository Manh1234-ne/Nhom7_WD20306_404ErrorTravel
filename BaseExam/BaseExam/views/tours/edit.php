<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Tour</title>
    <style>
        /* CSS giống như bạn đã gửi */
    </style>
</head>
<body>
<div class="container">
    <h1>Sửa Tour</h1>
    <form action="?action=tour_edit_post" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $tour['id'] ?>">

        <label>Tên Tour</label>
        <input type="text" name="ten_tour" value="<?= htmlspecialchars($tour['ten_tour']) ?>" required>

        <label>Loại Tour</label>
        <select name="loai_tour">
            <option value="trong_nuoc" <?= $tour['loai_tour']=='trong_nuoc'?'selected':'' ?>>Trong nước</option>
            <option value="quoc_te" <?= $tour['loai_tour']=='quoc_te'?'selected':'' ?>>Quốc tế</option>
            <option value="yeu_cau" <?= $tour['loai_tour']=='yeu_cau'?'selected':'' ?>>Yêu cầu</option>
        </select>

        <label>Giá</label>
        <input type="number" name="gia" value="<?= $tour['gia'] ?>">

        <label>Mô tả</label>
        <textarea name="mo_ta"><?= htmlspecialchars($tour['mo_ta']) ?></textarea>

        <label>Chính sách</label>
        <textarea name="chinh_sach"><?= htmlspecialchars($tour['chinh_sach']) ?></textarea>

        <label>Hình ảnh hiện tại</label>
        <?php if ($tour['hinh_anh']): ?>
            <img src="assets/uploads/tour/<?= $tour['hinh_anh'] ?>" width="120">
        <?php endif; ?>

        <label>Thay đổi hình ảnh</label>
        <input type="file" name="hinh_anh">

        <label>Album ảnh hiện tại</label>
        <?php if(!empty($album)): ?>
            <?php foreach($album as $img): ?>
                <div style="margin-bottom:10px;">
                    <img src="assets/uploads/tour/album/<?= $img->file_name ?>" width="120">
                    <div>
                        <label><input type="checkbox" name="delete_album[]" value="<?= $img->id ?>"> Xóa ảnh</label>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Chưa có ảnh trong album.</p>
        <?php endif; ?>

        <label>Thêm ảnh mới vào album</label>
        <input type="file" name="album[]" multiple>

        <button type="submit">Cập nhật Tour</button>
    </form>
    <a href="?action=tours">Quay lại</a>
</div>
</body>
</html>
