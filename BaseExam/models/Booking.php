<?php

require_once "BaseModel.php";

class Booking extends BaseModel {
    protected $table = "booking";

    public function create($data) {
        $sql = "INSERT INTO dat_tour (tour_id, ten_khach, so_dien_thoai, email, so_nguoi, ngay_khoi_hanh, trang_thai, tinh_trang_thanh_toan, yeu_cau_dac_biet, ghi_chu)
                VALUES (:tour_id, :ten_khach, :so_dien_thoai, :email, :so_nguoi, :ngay_khoi_hanh, :trang_thai, :tinh_trang_thanh_toan, :yeu_cau_dac_biet, :ghi_chu)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }
    
}