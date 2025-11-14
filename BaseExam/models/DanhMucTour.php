<?php
require_once __DIR__ . '/../configs/database.php';

class DanhMucTour {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    // Lấy tất cả danh mục
    public function getAllDanhMuc() {
        try {
            $sql = 'SELECT * FROM danh_muc_tour ORDER BY id DESC';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // Thêm danh mục mới
    public function insertDanhMuc($ten_tour, $mo_ta) {
        try {
            $sql = 'INSERT INTO danh_muc_tour (ten_tour, mo_ta) VALUES (:ten_tour, :mo_ta)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ten_tour' => $ten_tour,
                ':mo_ta' => $mo_ta
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // Lấy chi tiết danh mục theo id
    public function getDetailDanhMuc($id) {
        try {
            $sql = 'SELECT * FROM danh_muc_tour WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // Cập nhật danh mục
    public function updateDanhMuc($id, $ten_tour, $mo_ta) {
        try {
            $sql = 'UPDATE danh_muc_tour SET ten_tour = :ten_tour, mo_ta = :mo_ta WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ten_tour' => $ten_tour,
                ':mo_ta' => $mo_ta,
                ':id' => $id
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // Xóa danh mục
    public function destroyDanhMuc($id) {
        try {
            $sql = 'DELETE FROM danh_muc_tour WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
}