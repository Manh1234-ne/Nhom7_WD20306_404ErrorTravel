<?php
// views/albums/index.php
?>
<h2>Album ảnh</h2>
<p><a href="index.php?controller=albums&action=create">Tạo album mới</a></p>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Tiêu đề</th>
        <th>Mô tả</th>
        <th>Thao tác</th>
    </tr>
    <?php foreach ($albums as $a): ?>
        <tr>
            <td><?= htmlspecialchars($a['id']) ?></td>
            <td><?= htmlspecialchars($a['title']) ?></td>
            <td><?= nl2br(htmlspecialchars($a['description'])) ?></td>
            <td>
                <a href="index.php?controller=albums&action=show&id=<?= $a['id'] ?>">Xem</a> |
                <a href="index.php?controller=albums&action=edit&id=<?= $a['id'] ?>">Sửa</a> |
                <form action="index.php?controller=albums&action=destroy" method="post" style="display:inline"
                    onsubmit="return confirm('Xóa album?');">
                    <input type="hidden" name="id" value="<?= $a['id'] ?>">
                    <button type="submit">Xóa</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>