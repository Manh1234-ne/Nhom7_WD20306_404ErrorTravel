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
    // DANH SÁCH BOOKING + HDV
    // ===============================
    public function getAllWithHDV()
{
    $sql = "
        SELECT 
            dt.*,
            t.ten_tour,
            nd.ho_ten AS ten_hdv
        FROM dat_tour dt
        JOIN tour t ON dt.tour_id = t.id
        LEFT JOIN phan_cong_tour pct ON pct.tour_id = t.id
        LEFT JOIN huong_dan_vien hdv ON pct.huong_dan_vien_id = hdv.id
        LEFT JOIN nguoi_dung nd ON hdv.nguoi_dung_id = nd.id
        ORDER BY dt.id DESC
    ";

    return $this->db->query($sql)->fetchAll();
}
    // ===============================
    // KIỂM TRA ĐÃ CỌC
    // ===============================
    public function daTraCoc($booking_id)
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM dat_tour
            WHERE id = ?
            AND (tien_coc_da_tra > 0)
        ");
        $stmt->execute([$booking_id]);
        return $stmt->fetchColumn() > 0;
    }

    // ===============================
    // KIỂM TRA TOUR ĐÃ CÓ HDV
    // ===============================
    public function daPhanCongHDV($tour_id)
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM phan_cong_tour
            WHERE tour_id = ?
        ");
        $stmt->execute([$tour_id]);
        return $stmt->fetchColumn() > 0;
    }

    // ===============================
    // PHÂN CÔNG HDV
    // ===============================
    public function phanCongHDV($tour_id, $hdv_id, $ghi_chu)
    {
        $stmt = $this->db->prepare("
            INSERT INTO phan_cong_tour
            (tour_id, lich_khoi_hanh_id, huong_dan_vien_id, phuong_tien, ghi_chu)
            // VALUES (?,?, ?, 'Xe du lịch', ?)
        ");
        return $stmt->execute([$tour_id, $hdv_id, $ghi_chu]);
    }

    // ===============================
    // LẤY PHÂN CÔNG HDV
    // ===============================
    public function getPhanCongByTour($tour_id)
    {
        $stmt = $this->db->prepare("
            SELECT 
                pc.*,
                nd.ho_ten AS ten_hdv
            FROM phan_cong_tour pc
            JOIN huong_dan_vien hdv ON hdv.id = pc.huong_dan_vien_id
            JOIN nguoi_dung nd ON nd.id = hdv.nguoi_dung_id
            WHERE pc.tour_id = ?
            LIMIT 1
        ");
        $stmt->execute([$tour_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ===============================
    // DANH SÁCH HDV
    // ===============================
    public function getDanhSachHDV()
    {
        return $this->db->query("
            SELECT 
                hdv.id,
                nd.ho_ten
            FROM huong_dan_vien hdv
            JOIN nguoi_dung nd ON nd.id = hdv.nguoi_dung_id
        ")->fetchAll(PDO::FETCH_ASSOC);
    }
public function doiHDV($tour_id, $hdv_id)
{
    $stmt = $this->db->prepare("
        UPDATE phan_cong_tour
        SET huong_dan_vien_id = ?
        WHERE tour_id = ?
    ");
    return $stmt->execute([$hdv_id, $tour_id]);
}
 }


