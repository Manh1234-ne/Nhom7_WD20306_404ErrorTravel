<?php
require_once "BaseModel.php";

class Booking extends BaseModel
{
    protected $table = "dat_tour";

    public function create($data)
    {
        // Validation cho CCCD
        if (isset($data['cccd'])) {
            // Chỉ lấy số, bỏ ký tự khác
            $data['cccd'] = preg_replace('/[^0-9]/', '', $data['cccd']);
            
            // Kiểm tra độ dài CCCD (9-12 chữ số)
            if (strlen($data['cccd']) < 9 || strlen($data['cccd']) > 12) {
                throw new Exception('Số CCCD không hợp lệ. Vui lòng nhập 9-12 chữ số.');
            }
        }
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
        $result = $stmt->execute($data);
        
        if ($result) {
            return $this->db->lastInsertId();
        }
        return false;
    }
}
