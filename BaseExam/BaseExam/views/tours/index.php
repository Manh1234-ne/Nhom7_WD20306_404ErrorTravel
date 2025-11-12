<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách Tour</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { margin:0; font-family: Arial, sans-serif; background:#f5f5f5; }
        .sidebar { width:220px; background:#2c3e50; height:100vh; position:fixed; top:0; left:0; color:#fff; display:flex; flex-direction:column; }
        .sidebar h2 { text-align:center; padding:20px 0; border-bottom:1px solid #34495e; }
        .sidebar a { padding:15px 20px; color:#fff; text-decoration:none; display:flex; align-items:center; }
        .sidebar a:hover { background:#34495e; }
        .sidebar i { margin-right:10px; }
        .content { margin-left:220px; padding:30px; }
        table { width:100%; border-collapse:collapse; background:#fff; border-radius:8px; overflow:hidden; box-shadow:0 2px 5px rgba(0,0,0,0.1);}
        th, td { padding:12px; border-bottom:1px solid #ddd; text-align:left;}
        th { background:#3498db; color:#fff; }
        a.btn { padding:6px 12px; background:#3498db; color:#fff; border-radius:4px; text-decoration:none; margin-right:5px; }
        a.btn:hover { background:#2980b9; }
        .top-bar { display:flex; justify-content:space-between; margin-bottom:20px; }
        @media(max-width:768px){
            .sidebar { width:100%; height:auto; flex-direction:row; overflow-x:auto; }
            .sidebar h2 { display:none; }
            .sidebar a { flex:1; justify-content:center; }
            .content { margin-left:0; padding:20px;}
        }
    </style>
</head>
<body>
<div class="sidebar">
    <h2>Quản lý Tour</h2>
    <a href="?action=home"><i class="fa fa-home"></i>Trang chủ</a>
    <a href="?action=tours"><i class="fa fa-suitcase"></i>Quản</a>
    <a href="?action=nhansu"><i class="fa fa-user-tie"></i>Quản lý nhân sự</a>
</div>
<div class="content">
    <div class="top-bar">
        <h1>Danh sách Tour</h1>
        <a href="?action=tour_add" class="btn"><i class="fa fa-plus"></i> Thêm Tour</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Tour</th>
                <th>Loại Tour</th>
                <th>Giá</th>
                <th>Hình ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($tours as $tour): ?>
            <tr>
                <td><?= $tour['id'] ?></td>
                <td><?= htmlspecialchars($tour['ten_tour']) ?></td>
                <td><?= $tour['loai_tour'] ?></td>
                <td><?= number_format($tour['gia'],0,',','.') ?> VNĐ</td>
                <td>
                    <?php if($tour['hinh_anh']): ?>
                        <img src="assets/uploads/<?= $tour['hinh_anh'] ?>" width="80">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="?action=tour_edit&id=<?= $tour['id'] ?>" class="btn"><i class="fa fa-edit"></i> Sửa</a>
                    <a href="?action=tour_delete&id=<?= $tour['id'] ?>" class="btn" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i class="fa fa-trash"></i> Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
