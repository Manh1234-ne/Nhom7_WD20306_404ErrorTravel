<?php
require_once 'BaseModel.php';

class qlb extends BaseModel
{
    protected $table = 'dat_tour';

    // ===============================
    // FORMAT TIỀN
    // ===============================
    public static function formatVND($number)
    {
        if ($number >= 100000000) {
            return round($number / 1000000) . ' triệu';
        } elseif ($number >= 1000000) {
            $million = $number / 1000000;
            return ($million == (int)$million) ? $million . ' triệu' : round($million, 1) . ' triệu';
        } elseif ($number >= 1000) {
            $thousand = $number / 1000;
            return ($thousand == (int)$thousand) ? $thousand . ' nghìn' : round($thousand, 1) . ' nghìn';
        } else {
            return $number . ' VNĐ';
        }
    }

    // ===============================
    // KHÁCH CÙNG TOUR
    // ===============================
    public function getCustomersByTour($tour_id)
    {
        $sql = "
            SELECT *,
                (IFNULL(tien_coc_da_tra,0) + IFNULL(tien_full_da_tra,0)) AS tong_da_tra
            FROM dat_tour
            WHERE tour_id = ?
            ORDER BY id DESC
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$tour_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===============================
    // KIỂM TRA ĐÃ CỌC CHƯA
    // ===============================
    public function daTraCoc($booking_id)
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM dat_tour
            WHERE id = ?
            AND tinh_trang_thanh_toan IN ('Đã cọc','Đã thanh toán')
        ");
        $stmt->execute([$booking_id]);
        return $stmt->fetchColumn() > 0;
    }

    // ===============================
    // KIỂM TRA ĐÃ PHÂN CÔNG HDV CHƯA
    // ===============================
    public function daPhanCongHDV($lich_khoi_hanh_id)
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM phan_cong_tour
            WHERE lich_khoi_hanh_id = ?
        ");
        $stmt->execute([$lich_khoi_hanh_id]);
        return $stmt->fetchColumn() > 0;
    }

    // ===============================
    // LẤY PHÂN CÔNG HDV
    // ===============================
    public function getPhanCongHDV($lich_khoi_hanh_id)
    {
        $stmt = $this->db->prepare("
            SELECT pc.*, ns.ten_nhan_su
            FROM phan_cong_tour pc
            JOIN nhan_su ns ON pc.hdv_id = ns.id
            WHERE pc.lich_khoi_hanh_id = ?
            LIMIT 1
        ");
        $stmt->execute([$lich_khoi_hanh_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ===============================
    // PHÂN CÔNG HDV
    // ===============================
    public function phanCongHDV($lich_khoi_hanh_id, $hdv_id)
    {
        $stmt = $this->db->prepare("
            INSERT INTO phan_cong_tour
            (lich_khoi_hanh_id, hdv_id, phuong_tien, ghi_chu)
            VALUES (?, ?, 'Xe du lịch', 'Phân công sau khi booking đã cọc')
        ");
        return $stmt->execute([$lich_khoi_hanh_id, $hdv_id]);
    }
}
