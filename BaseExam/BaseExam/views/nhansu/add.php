<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Thêm Hướng Dẫn Viên</title>
<style>
    body { font-family: Arial, sans-serif; background: #f7f7f7; margin: 0; padding: 0; display: flex; justify-content: center; align-items: flex-start; min-height: 100vh; }
    .container { background: #fff; padding: 20px 30px; margin-top: 50px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); width: 400px; }
    h2 { text-align: center; margin-bottom: 20px; color: #333; }
    label { display: block; margin-top: 12px; font-weight: bold; color: #555; }
    input, textarea { width: 100%; padding: 8px; margin-top: 4px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; }
    button { width: 100%; margin-top: 20px; padding: 10px; background: #28a745; color: #fff; font-weight: bold; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
    button:hover { background: #218838; }
    .back { display: block; text-align: center; margin-top: 15px; color: #007bff; text-decoration: none; }
    .back:hover { text-decoration: underline; }
</style>
</head>
<body>

<div class="container">
    <h2>Thêm Hướng Dẫn Viên</h2>

    <form action="?action=nhansu_add_post" method="POST">
        <label>Họ tên:</label>
        <input type="text" name="ho_ten" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Số điện thoại:</label>
        <input type="text" name="so_dien_thoai" required>

        <label>Ngôn ngữ:</label>
        <input type="text" name="ngon_ngu" required>

        <label>Kinh nghiệm:</label>
        <textarea name="kinh_nghiem" rows="3" required></textarea>

        <label>Đánh giá (0-5):</label>
        <input type="number" name="danh_gia" min="0" max="5" step="0.1" required>

        <button type="submit">Thêm mới</button>
    </form>

    <a class="back" href="?action=nhansu">← Quay lại danh sách</a>
</div>

</body>
</html>
