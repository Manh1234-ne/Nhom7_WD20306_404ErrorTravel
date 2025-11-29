<?php
require_once 'BaseModel.php';

class Tour extends BaseModel
{
    protected $table = 'tour';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Tạo tour và trả về id mới (wrapper trả về lastInsertId)
     * Sử dụng khi cần id để lưu album
     */
    public function create(array $data)
    {
        $keys = array_keys($data);
        $fields = implode(',', $keys);
        $placeholders = implode(',', array_fill(0, count($keys), '?'));
        $stmt = $this->db->prepare("INSERT INTO {$this->table} ($fields) VALUES ($placeholders)");
        $res = $stmt->execute(array_values($data));
        if ($res) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    // Nếu bạn muốn vẫn dùng insert() từ BaseModel, nó trả về boolean.
    // Album
    public function getAlbum($tour_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM album_tour WHERE tour_id = ?");
        $stmt->execute([$tour_id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function insertAlbum($tour_id, $file_name)
    {
        $created_at = date('Y-m-d H:i:s');
        $stmt = $this->db->prepare("INSERT INTO album_tour (tour_id, file_name, created_at) VALUES (?, ?, ?)");
        return $stmt->execute([$tour_id, $file_name, $created_at]);
    }

    public function deleteAlbum($id)
    {
        $stmt = $this->db->prepare("DELETE FROM album_tour WHERE id = ?");
        return $stmt->execute([$id]);
    }

    /**
     * Lấy HDV theo nhan_su_id của tour (nếu có)
     * Trả về assoc (ho_ten, so_dien_thoai, email, ngon_ngu, kinh_nghiem, danh_gia) hoặc false
     */
    public function getHDVByTour($tour_id)
    {
        $sql = "
            SELECT hdv.*, nd.ho_ten, nd.so_dien_thoai, nd.email
            FROM tour t
            LEFT JOIN huong_dan_vien hdv ON hdv.id = t.nhan_su_id
            LEFT JOIN nguoi_dung nd ON nd.id = hdv.nguoi_dung_id
            WHERE t.id = ?
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$tour_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row : false;
    }

    /**
     * Thử lấy HDV mặc định theo một khóa loại (từ DB nếu trường loai_hdv tồn tại)
     * Nếu DB không chứa kiểu này hoặc không có cấu trúc, trả về false.
     * Caller sẽ fallback sang mapping hard-coded nếu cần.
     */
    public function getDefaultHDVFromDB($loai_hdv_key)
    {
        // Query mong muốn: huong_dan_vien.loai_hdv = :loai_hdv_key
        // Nếu DB không có cột loai_hdv, query này không trả lỗi nhưng sẽ trả rỗng.
        try {
            $sql = "
                SELECT hdv.*, nd.ho_ten, nd.so_dien_thoai, nd.email
                FROM huong_dan_vien hdv
                LEFT JOIN nguoi_dung nd ON nd.id = hdv.nguoi_dung_id
                WHERE hdv.loai_hdv = :loai
                LIMIT 1
            ";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['loai' => $loai_hdv_key]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ? $row : false;
        } catch (Throwable $e) {
            // Nếu DB không có cột loai_hdv hoặc query lỗi, trả về false để caller fallback.
            return false;
        }
    }
}
