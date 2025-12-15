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
    // 👉 DANH SÁCH KHÁCH CÙNG TOUR (THÊM)
    // ===============================
    public function getCustomersByTour($tour_id)
    {
        $sql = "
            SELECT 
                *,
                (IFNULL(tien_coc_da_tra,0) + IFNULL(tien_full_da_tra,0)) AS tong_da_tra
            FROM dat_tour
            WHERE tour_id = ?
            ORDER BY id DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$tour_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
