<?php
require_once 'BaseModel.php';

class Tour extends BaseModel {
    protected $table = 'tour';

    public static function formatVND($number) {
        if ($number >= 100000000) {
            return round($number / 1000000) . ' triệu';
        } elseif ($number >= 1000000) {
            $million = $number / 1000000;
            return ($million == (int)$million) ? $million.' triệu' : round($million,1).' triệu';
        } elseif ($number >= 1000) {
            $thousand = $number / 1000;
            return ($thousand == (int)$thousand) ? $thousand.' nghìn' : round($thousand,1).' nghìn';
        } else {
            return $number.' VNĐ';
        }
    }

    public function getAlbum($tour_id) {
        $stmt = $this->db->prepare("SELECT * FROM album_tour WHERE tour_id = ?");
        $stmt->execute([$tour_id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function insertAlbum($tour_id, $file_name) {
        $stmt = $this->db->prepare("INSERT INTO album_tour (tour_id, file_name) VALUES (?, ?)");
        return $stmt->execute([$tour_id, $file_name]);
    }

    public function deleteAlbum($id) {
        $stmt = $this->db->prepare("DELETE FROM album_tour WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
 