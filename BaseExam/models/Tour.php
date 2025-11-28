<?php
require_once 'BaseModel.php';

class Tour extends BaseModel
{
    protected $table = 'tour';

    // Format số tiền
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

    // Lấy album của tour
    public function getAlbum($tour_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM album_tour WHERE tour_id = ?");
        $stmt->execute([$tour_id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Thêm album mới
    public function insertAlbum($tour_id, $file_name)
    {
        $created_at = date('Y-m-d H:i:s'); // tự động thêm thời gian
        $stmt = $this->db->prepare("INSERT INTO album_tour (tour_id, file_name, created_at) VALUES (?, ?, ?)");
        return $stmt->execute([$tour_id, $file_name, $created_at]);
    }

    // Lấy 1 ảnh theo id
    public function getAlbumById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM album_tour WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Xóa album (xóa file trên disk rồi xóa DB)
    public function deleteAlbum($id)
    {
        // Lấy thông tin file trước
        $album = $this->getAlbumById($id);
        if ($album && !empty($album->file_name)) {
            $fullPath = PATH_ASSETS_UPLOADS . $album->file_name; // PATH_ASSETS_UPLOADS đã định nghĩa trong env.php
            if (file_exists($fullPath)) {
                @unlink($fullPath);
            }
        }

        $stmt = $this->db->prepare("DELETE FROM album_tour WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Xóa tour kèm các bản ghi phụ trong transaction
    public function deleteWithRelations($id)
    {
        try {
            $this->db->beginTransaction();

            // xóa album
            $stmt = $this->db->prepare("DELETE FROM album_tour WHERE tour_id = ?");
            $stmt->execute([$id]);

            // xóa booking/dat_tour
            $stmt = $this->db->prepare("DELETE FROM dat_tour WHERE tour_id = ?");
            $stmt->execute([$id]);

            // xóa bản ghi tour
            $stmt = $this->db->prepare("DELETE FROM tour WHERE id = ?");
            $stmt->execute([$id]);

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
}
