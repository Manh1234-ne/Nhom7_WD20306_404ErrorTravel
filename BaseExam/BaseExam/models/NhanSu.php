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
    $stmt = $this->db->prepare("INSERT INTO nhan_su (ho_ten, email, so_dien_thoai, ngon_ngu, kinh_nghiem, danh_gia) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $data['ho_ten'],
        $data['email'],
        $data['so_dien_thoai'],
        $data['ngon_ngu'],
        $data['kinh_nghiem'],
        $data['danh_gia']
    ]);
}

public function updateNhanSu($id, $data) {
    $stmt = $this->db->prepare("UPDATE nhan_su SET ho_ten=?, email=?, so_dien_thoai=?, ngon_ngu=?, kinh_nghiem=?, danh_gia=? WHERE id=?");
    $stmt->execute([
        $data['ho_ten'],
        $data['email'],
        $data['so_dien_thoai'],
        $data['ngon_ngu'],
        $data['kinh_nghiem'],
        $data['danh_gia'],
        $id
    ]);
}

public function getNhanSuById($id) {
    $stmt = $this->db->prepare("SELECT * FROM nhan_su WHERE id=?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


    public function deleteNhanSu($id) {
        // Lấy nguoi_dung_id
        $stmt = $this->db->prepare("SELECT nguoi_dung_id FROM huong_dan_vien WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $nguoi_dung_id = $stmt->fetchColumn();

        // Xóa hdv trước
        $stmt1 = $this->db->prepare("DELETE FROM huong_dan_vien WHERE id = :id");
        $stmt1->execute(['id' => $id]);

        // Xóa nguoi_dung
        $stmt2 = $this->db->prepare("DELETE FROM nguoi_dung WHERE id = :id");
        $stmt2->execute(['id' => $nguoi_dung_id]);
    }
}