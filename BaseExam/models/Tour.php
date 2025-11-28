<?php
require_once 'BaseModel.php';

class Tour extends BaseModel
{
    protected $table = 'tour';

    public function __construct()
    {
        parent::__construct(); // Quan trọng – để khởi tạo $this->db
    }

    /* ====================== FORMAT GIÁ TOUR ====================== */
    public static function formatVND($number)
    {
        if ($number >= 100000000) {
            return round($number / 1000000) . ' triệu';
        } elseif ($number >= 1000000) {
            $million = $number / 1000000;
            return ($million == (int) $million) ? $million . ' triệu' : round($million, 1) . ' triệu';
        } elseif ($number >= 1000) {
            $thousand = $number / 1000;
            return ($thousand == (int) $thousand) ? $thousand . ' nghìn' : round($thousand, 1) . ' nghìn';
        } else {
            return $number . ' VNĐ';
        }
    }

    /* ====================== LẤY ALBUM TOUR ====================== */
    public function getAlbum($tour_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM album_tour WHERE tour_id = ?");
        $stmt->execute([$tour_id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /* ====================== THÊM ALBUM ====================== */
    public function insertAlbum($tour_id, $file_name)
    {
        $created_at = date('Y-m-d H:i:s');
        $stmt = $this->db->prepare("
            INSERT INTO album_tour (tour_id, file_name, created_at)
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$tour_id, $file_name, $created_at]);
    }

    /* ====================== XÓA ALBUM ====================== */
    public function deleteAlbum($id)
    {
        $stmt = $this->db->prepare("DELETE FROM album_tour WHERE id = ?");
        return $stmt->execute([$id]);
    }

    /* ====================== LẤY HƯỚNG DẪN VIÊN CỦA TOUR ====================== */
    public function getHDVByTour($tour_id)
    {
        $sql = "
            SELECT 
                hdv.*, 
                nd.ho_ten, 
                nd.so_dien_thoai, 
                nd.email
            FROM tour t
            LEFT JOIN huong_dan_vien hdv ON hdv.id = t.nhan_su_id
            LEFT JOIN nguoi_dung nd ON nd.id = hdv.nguoi_dung_id
            WHERE t.id = ?
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$tour_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
