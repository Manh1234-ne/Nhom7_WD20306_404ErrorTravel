<?php
require_once __DIR__ . '/../configs/database.php';

class NguoiDung {
    private $conn;

    public function __construct() {
        $this->conn = connectDB(); // hàm connectDB() trả về PDO trong file connect.php
    }

    public function findByUsername($ten_dang_nhap) {
        $sql = "SELECT * FROM nguoi_dung WHERE ten_dang_nhap = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$ten_dang_nhap]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByEmail($email) {
        $sql = "SELECT * FROM nguoi_dung WHERE email = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $sql = "SELECT * FROM nguoi_dung WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // public function create($data) {
    //     $sql = "INSERT INTO nguoi_dung (ho_ten, ten_dang_nhap, mat_khau, email, so_dien_thoai, vai_tro)
    //             VALUES (:ho_ten, :ten_dang_nhap, :mat_khau, :email, :so_dien_thoai, :vai_tro)";
    //     $stmt = $this->conn->prepare($sql);
    //     return $stmt->execute([
    //         ':ho_ten' => $data['ho_ten'],
    //         ':ten_dang_nhap' => $data['ten_dang_nhap'],
    //         ':mat_khau' => $data['mat_khau'],
    //         ':email' => $data['email'] ?? null,
    //         ':so_dien_thoai' => $data['so_dien_thoai'] ?? null,
    //         ':vai_tro' => $data['vai_tro'] ?? 0
    //     ]);
    // }
}