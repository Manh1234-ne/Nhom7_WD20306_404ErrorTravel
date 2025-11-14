<?php
function connectDB() {
    try {
        $conn = new PDO("mysql:host=localhost;dbname=tour_du_lich;charset=utf8", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (Exception $e) {
        die("Lỗi kết nối CSDL: " . $e->getMessage());
    }
}