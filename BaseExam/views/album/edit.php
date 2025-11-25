<?php
// views/albums/edit.php
?>
<h2>Sửa album</h2>

<form action="index.php?controller=albums&action=update" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $album['id'] ?>">
    <div>
        <label>Tiêu đề</label><br>
        <input type="text" name="title" value="<?= htmlspecialchars($album['title']) ?>" required>
    </div>
    <div>
        <label>Mô tả</label><br>
        <textarea name="description"><?= htmlspecialchars($album['description']) ?></textarea>
    </div>
    <div>
        <label>Upload thêm ảnh</label><br>
        <input type="file" name="images[]" accept="image/*" multiple>
    </div>
    <div>
        <button type="submit">Lưu</button>
    </div>
</form>

<h3>Ảnh trong album</h3>
<div style="display:flex; flex-wrap:wrap;">
    <?php foreach ($images as $img):
        $url = $this->uploadWebPath . $img['filename'];
        ?>
        <div style="margin:8px; text-align:center;">
            <img src="<?= $url ?>" style="width:160px; height:120px; object-fit:cover; display:block;">
            <div><?= htmlspecialchars($img['original_name']) ?></div>
            <button class="del-btn" data-id="<?= $img['id'] ?>">Xóa</button>
        </div>
    <?php endforeach; ?>
</div>

<script>
    document.querySelectorAll('.del-btn').forEach(btn => {
        btn.addEventListener('click', e => {
            if (!confirm('Xóa ảnh này?')) return;
            const id = btn.dataset.id;
            fetch('index.php?controller=albums&action=deleteImage', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'image_id=' + encodeURIComponent(id)
            }).then(r => r.json()).then(j => {
                if (j.success) location.reload();
                else alert('Lỗi khi xóa');
            })
        })
    })
</script>