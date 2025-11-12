<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Tour</title>
    <style>
        body { font-family: Arial; background:#f5f5f5; padding:30px; }
        form { background:#fff; padding:20px; border-radius:8px; width:600px; margin:auto; box-shadow:0 2px 5px rgba(0,0,0,0.1);}
        label { display:block; margin-top:15px; }
        input, textarea, select { width:100%; padding:8px; margin-top:5px; border-radius:4px; border:1px solid #ccc; }
        button { margin-top:20px; padding:10px 20px; border:none; border-radius:4px; background:#3498db; color:#fff; cursor:pointer; }
        button:hover { background:#2980b9; }
        a { display:inline-block; margin-top:10px; color:#3498db; text-decoration:none; }
    </style>
</head>
<body>
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
        <label>
