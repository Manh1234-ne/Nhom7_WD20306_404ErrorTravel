<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Tour</title>
    <style>
        /* CSS giống như bạn đã gửi */
    </style>
</head>
<body>
<div class="container">
    <h1>Thêm Tour</h1>
    <form action="?action=tour_add_post" method="post" enctype="multipart/form-data">
        <label>Tên Tour</label>
        <input type="text" name="ten_tour" required>

        <label>Loại Tour</label>
        <select name="loai_tour">
            <option value="trong_nuoc">Trong nước</option>
            <option value="quoc_te">Quốc tế</option>
            <option value="yeu_cau">Yêu cầu</option>
        </select>

        <label>Mô tả</label>
        <textarea name="mo_ta"></textarea>

        <label>Giá</label>
        <input type="number" name="gia">

        <label>Chính sách</label>
        <textarea name="chinh_sach"></textarea>

        <label>Hình ảnh</label>
        <input type="file" name="hinh_anh">

        <hr>
        <label>Album ảnh</label>
        <input type="file" name="album[]" multiple>

        <button type="submit">Thêm Tour</button>
    </form>
    <a href="?action=tours">Quay lại</a>
</div>
</body>
</html>
 