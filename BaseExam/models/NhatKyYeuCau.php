<?php

require_once __DIR__ . '/../configs/database.php';

class NhatKyYeuCau
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy toàn bộ nhật ký của 1 yêu cầu
    public function getAllByYeuCau($idYeuCau)
    {
        $sql = "SELECT * FROM nhat_ky_xu_ly_yeu_cau 
                WHERE id_yeu_cau = ?
                ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idYeuCau]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy 1 bản ghi nhật ký
    public function getOne($id)
    {
        $sql = "SELECT * FROM nhat_ky_xu_ly_yeu_cau WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm nhật ký mới
    public function add($data)
    {
        $sql = "INSERT INTO nhat_ky_xu_ly_yeu_cau 
                (id_yeu_cau, nguoi_xu_ly, ghi_chu, trang_thai_cu, trang_thai_moi)
                VALUES (:id_yeu_cau, :nguoi_xu_ly, :ghi_chu, :trang_thai_cu, :trang_thai_moi)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }
}
