<?php
require_once "BaseModel.php";

class Booking extends BaseModel
{
    protected $table = "dat_tour";

    public function create($data)
    {
        $sql = "INSERT INTO dat_tour (
                    tour_id, ten_khach, so_dien_thoai, email, cccd,
                    so_nguoi, ngay_khoi_hanh, gia,
                    trang_thai, tinh_trang_thanh_toan,
                    tien_coc, yeu_cau_dac_biet, ghi_chu, danh_sach_file
                ) VALUES (
                    :tour_id, :ten_khach, :so_dien_thoai, :email, :cccd,
                    :so_nguoi, :ngay_khoi_hanh, :gia,
                    :trang_thai, :tinh_trang_thanh_toan,
                    :tien_coc, :yeu_cau_dac_biet, :ghi_chu, :danh_sach_file
                )";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }
}
