<?php
// views/albums/detail.php
?>
<h2><?= htmlspecialchars($album['title']) ?></h2>
<p><?= nl2br(htmlspecialchars($album['description'])) ?></p>
<div style="display:flex; flex-wrap:wrap;">
    <?php foreach ($images as $img):
        $url = $this->uploadWebPath . $img['filename'];
        ?>
        <div style="margin:6px;">
            <a href="<?= $url ?>" target="_blank">
                <img src="<?= $url ?>" style="width:200px; height:150px; object-fit:cover;">
            </a>
        </div>
    <?php endforeach; ?>
</div>
<p><a href="index.php?controller=albums&action=index">Quay lại</a></p>