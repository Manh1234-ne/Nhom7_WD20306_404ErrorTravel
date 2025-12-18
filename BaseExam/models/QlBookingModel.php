<?php
require_once 'BaseModel.php';

class qlb extends BaseModel
{
    protected $table = 'dat_tour';

    // ===============================
    // LẤY TẤT CẢ BOOKING
    // ===============================
    public function all()
    {
        return $this->db
            ->query("SELECT * FROM dat_tour ORDER BY id ASC")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===============================
    // KIỂM TRA ĐÃ TRẢ CỌC CHƯA
    // ===============================
    public function daTraCoc($booking_id)
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) 
            FROM dat_tour
            WHERE id = ?
              AND tinh_trang_thanh_toan IN ('Đã cọc', 'Đã thanh toán')
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
            SELECT COUNT(*) 
            FROM phan_cong_tour
            WHERE lich_khoi_hanh_id = ?
        ");
        $stmt->execute([$lich_khoi_hanh_id]);
        return $stmt->fetchColumn() > 0;
    }

    // ===============================
    // PHÂN CÔNG HDV
    // ===============================
    public function phanCongHDV($lich_khoi_hanh_id, $hdv_id, $ghi_chu = '')
    {
        $stmt = $this->db->prepare("
            INSERT INTO phan_cong_tour
                (lich_khoi_hanh_id, huong_dan_vien_id, phuong_tien, ghi_chu)
            VALUES (?, ?, 'Xe du lịch', ?)
        ");

        return $stmt->execute([
            $lich_khoi_hanh_id,
            $hdv_id,
            $ghi_chu
        ]);
    }

    // ===============================
    // ĐỔI HDV
    // ===============================
    public function doiHDV($lich_khoi_hanh_id, $hdv_id)
    {
        $stmt = $this->db->prepare("
            UPDATE phan_cong_tour
            SET huong_dan_vien_id = ?
            WHERE lich_khoi_hanh_id = ?
        ");

        return $stmt->execute([
            $hdv_id,
            $lich_khoi_hanh_id
        ]);
    }

    // ===============================
    // LẤY THÔNG TIN HDV ĐÃ PHÂN CÔNG
    // ===============================
    public function getPhanCongHDV($lich_khoi_hanh_id)
    {
        $stmt = $this->db->prepare("
            SELECT 
                pc.*,
                nd.ho_ten AS ten_hdv
            FROM phan_cong_tour pc
            JOIN huong_dan_vien hdv ON hdv.id = pc.huong_dan_vien_id
            JOIN nguoi_dung nd ON nd.id = hdv.nguoi_dung_id
            WHERE pc.lich_khoi_hanh_id = ?
            LIMIT 1
        ");

        $stmt->execute([$lich_khoi_hanh_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ===============================
    // DANH SÁCH HDV
    // ===============================
    public function getDanhSachHDV()
    {
        return $this->db->query("
            SELECT hdv.id, nd.ho_ten
            FROM huong_dan_vien hdv
            JOIN nguoi_dung nd ON nd.id = hdv.nguoi_dung_id
        ")->fetchAll(PDO::FETCH_ASSOC);
    }
}
