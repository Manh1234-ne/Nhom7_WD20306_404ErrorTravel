<?php
require_once 'BaseModel.php';

class NhanSu extends BaseModel
{
    protected $table = 'huong_dan_vien'; // Chỉ dùng cho HDV

    /**
     * Lấy danh sách nhân sự kèm thông tin người dùng
     */
    public function getAllWithNguoiDung()
    {
        $sql = "SELECT nd.id AS nguoi_dung_id, nd.ho_ten, nd.email, nd.so_dien_thoai, nd.vai_tro,
                       hdv.ngon_ngu, hdv.kinh_nghiem, hdv.danh_gia, hdv.id AS hdv_id
                FROM nguoi_dung nd
                LEFT JOIN huong_dan_vien hdv ON nd.id = hdv.nguoi_dung_id
                ORDER BY nd.id ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Lấy 1 nhân sự kèm thông tin người dùng
     */
    public function findWithNguoiDung($id)
    {
        $sql = "SELECT nd.id AS nguoi_dung_id, nd.ho_ten, nd.email, nd.so_dien_thoai, nd.vai_tro,
                       hdv.ngon_ngu, hdv.kinh_nghiem, hdv.danh_gia, hdv.id AS hdv_id
                FROM nguoi_dung nd
                LEFT JOIN huong_dan_vien hdv ON nd.id = hdv.nguoi_dung_id
                WHERE nd.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Thêm mới nhân sự
     */
    public function createNhanSu($data)
    {
        // Thêm vào bảng nguoi_dung
        $stmt1 = $this->db->prepare("
            INSERT INTO nguoi_dung (ho_ten, email, so_dien_thoai, ten_dang_nhap, mat_khau, vai_tro) 
            VALUES (:ho_ten, :email, :so_dien_thoai, :ten_dang_nhap, :mat_khau, :vai_tro)
        ");
        $stmt1->execute([
            'ho_ten' => $data['ho_ten'],
            'email' => $data['email'],
            'so_dien_thoai' => $data['so_dien_thoai'],
            'ten_dang_nhap' => $data['email'],
            'mat_khau' => password_hash('123456', PASSWORD_DEFAULT),
            'vai_tro' => $data['vai_tro']
        ]);

        $nguoi_dung_id = $this->db->lastInsertId();

        // Nếu là HDV, thêm vào bảng huong_dan_vien
        if ($data['vai_tro'] === 'Hướng dẫn viên') {
            $stmt2 = $this->db->prepare("
                INSERT INTO huong_dan_vien (nguoi_dung_id, ngon_ngu, kinh_nghiem, danh_gia)
                VALUES (:nguoi_dung_id, :ngon_ngu, :kinh_nghiem, :danh_gia)
            ");
            $stmt2->execute([
                'nguoi_dung_id' => $nguoi_dung_id,
                'ngon_ngu' => $data['ngon_ngu'] ?? '',
                'kinh_nghiem' => $data['kinh_nghiem'] ?? '',
                'danh_gia' => $data['danh_gia'] ?? 0
            ]);
        }
    }

    /**
     * Cập nhật nhân sự
     */
    public function updateNhanSu($id, $data)
    {
        // Cập nhật thông tin chung trong bảng nguoi_dung
        $fields = "ho_ten = :ho_ten, email = :email, so_dien_thoai = :so_dien_thoai";
        $params = [
            'ho_ten' => $data['ho_ten'],
            'email' => $data['email'],
            'so_dien_thoai' => $data['so_dien_thoai'],
            'id' => $id
        ];

        // Nếu admin, cho phép cập nhật vai trò
        if (isset($data['vai_tro']) && $_SESSION['user']['vai_tro'] === 'admin') {
            $fields .= ", vai_tro = :vai_tro";
            $params['vai_tro'] = $data['vai_tro'];
        }

        $sql1 = "UPDATE nguoi_dung SET $fields WHERE id = :id";
        $stmt1 = $this->db->prepare($sql1);
        $stmt1->execute($params);

        // Nếu nhân sự là HDV, cập nhật bảng huong_dan_vien
        $stmtCheck = $this->db->prepare("SELECT id FROM huong_dan_vien WHERE nguoi_dung_id = :id");
        $stmtCheck->execute(['id' => $id]);
        $hdv_id = $stmtCheck->fetchColumn();

        if ($hdv_id) {
            $stmt2 = $this->db->prepare("
                UPDATE huong_dan_vien SET 
                    ngon_ngu = :ngon_ngu,
                    kinh_nghiem = :kinh_nghiem,
                    danh_gia = :danh_gia
                WHERE nguoi_dung_id = :id
            ");
            $stmt2->execute([
                'ngon_ngu' => $data['ngon_ngu'] ?? '',
                'kinh_nghiem' => $data['kinh_nghiem'] ?? '',
                'danh_gia' => $data['danh_gia'] ?? 0,
                'id' => $id
            ]);
        }
    }

    /**
     * Xóa nhân sự
     */
    public function deleteNhanSu($id)
    {
        // Nếu là HDV, xóa bảng huong_dan_vien trước
        $stmtCheck = $this->db->prepare("SELECT id FROM huong_dan_vien WHERE nguoi_dung_id = :id");
        $stmtCheck->execute(['id' => $id]);
        $hdv_id = $stmtCheck->fetchColumn();

        if ($hdv_id) {
            $this->db->prepare("DELETE FROM huong_dan_vien WHERE id = :id")->execute(['id' => $hdv_id]);
        }

        // Xóa bảng nguoi_dung
        $this->db->prepare("DELETE FROM nguoi_dung WHERE id = :id")->execute(['id' => $id]);
    }
        // ===============================
    // [NEW] Lấy danh sách HDV để phân công tour
    // ===============================
    public function getAllHDVForAssign()
    {
        $sql = "
            SELECT hdv.id AS hdv_id, nd.ho_ten, nd.email, nd.so_dien_thoai,
                   hdv.ngon_ngu, hdv.kinh_nghiem, hdv.danh_gia
            FROM huong_dan_vien hdv
            JOIN nguoi_dung nd ON hdv.nguoi_dung_id = nd.id
            WHERE nd.vai_tro = 'Hướng dẫn viên'
            ORDER BY nd.ho_ten ASC
        ";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

}
