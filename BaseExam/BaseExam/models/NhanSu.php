<?php
require_once 'BaseModel.php';

class NhanSu extends BaseModel {
    protected $table = 'huong_dan_vien';

    public function getAllWithNguoiDung() {
        $stmt = $this->db->query("
            SELECT hdv.*, nd.ho_ten, nd.email, nd.so_dien_thoai, nd.id as nguoi_dung_id
            FROM huong_dan_vien hdv
            JOIN nguoi_dung nd ON hdv.nguoi_dung_id = nd.id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findWithNguoiDung($id) {
        $stmt = $this->db->prepare("
            SELECT hdv.*, nd.ho_ten, nd.email, nd.so_dien_thoai, nd.id as nguoi_dung_id
            FROM huong_dan_vien hdv
            JOIN nguoi_dung nd ON hdv.nguoi_dung_id = nd.id
            WHERE hdv.id = :id
        ");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createNhanSu($data) {
        $stmt = $this->db->prepare("
            INSERT INTO huong_dan_vien (nguoi_dung_id, ngon_ngu, kinh_nghiem, danh_gia)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([
            $data['nguoi_dung_id'] ?? null,
            $data['ngon_ngu'] ?? null,
            $data['kinh_nghiem'] ?? null,
            $data['danh_gia'] ?? 0
        ]);
    }

    public function updateNhanSu($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE huong_dan_vien
            SET nguoi_dung_id=?, ngon_ngu=?, kinh_nghiem=?, danh_gia=?
            WHERE id=?
        ");
        $stmt->execute([
            $data['nguoi_dung_id'] ?? null,
            $data['ngon_ngu'] ?? null,
            $data['kinh_nghiem'] ?? null,
            $data['danh_gia'] ?? 0,
            $id
        ]);
    }

    public function getNhanSuById($id) {
        $stmt = $this->db->prepare("SELECT * FROM huong_dan_vien WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteNhanSu($id) {
        $stmt = $this->db->prepare("SELECT nguoi_dung_id FROM huong_dan_vien WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $nguoi_dung_id = $stmt->fetchColumn();

        $stmt1 = $this->db->prepare("DELETE FROM huong_dan_vien WHERE id = :id");
        $stmt1->execute(['id' => $id]);

        $stmt2 = $this->db->prepare("DELETE FROM nguoi_dung WHERE id = :id");
        $stmt2->execute(['id' => $nguoi_dung_id]);
    }
}
