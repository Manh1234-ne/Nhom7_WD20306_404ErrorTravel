<?php
require_once 'BaseModel.php';

class NhanSu extends BaseModel
{
    protected $table = 'huong_dan_vien';

    public function getAllWithNguoiDung()
    {
        $sql = "SELECT hdv.*, nd.ho_ten, nd.email, nd.so_dien_thoai
                FROM huong_dan_vien hdv
                JOIN nguoi_dung nd ON hdv.nguoi_dung_id = nd.id";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findWithNguoiDung($id)
    {
        $sql = "SELECT hdv.*, nd.ho_ten, nd.email, nd.so_dien_thoai
                FROM huong_dan_vien hdv
                JOIN nguoi_dung nd ON hdv.nguoi_dung_id = nd.id
                WHERE hdv.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createNhanSu($data)
    {
        $stmt1 = $this->db->prepare("INSERT INTO nguoi_dung (ho_ten, email, so_dien_thoai, ten_dang_nhap, mat_khau, vai_tro) 
                                     VALUES (:ho_ten, :email, :so_dien_thoai, :ten_dang_nhap, :mat_khau, 'huong_dan_vien')");
        $stmt1->execute([
            'ho_ten' => $data['ho_ten'],
            'email' => $data['email'],
            'so_dien_thoai' => $data['so_dien_thoai'],
            'ten_dang_nhap' => $data['email'],
            'mat_khau' => password_hash('123456', PASSWORD_DEFAULT)
        ]);
        $nguoi_dung_id = $this->db->lastInsertId();

        $stmt2 = $this->db->prepare("INSERT INTO huong_dan_vien (nguoi_dung_id, ngon_ngu, kinh_nghiem, danh_gia)
                                     VALUES (:nguoi_dung_id, :ngon_ngu, :kinh_nghiem, :danh_gia)");
        $stmt2->execute([
            'nguoi_dung_id' => $nguoi_dung_id,
            'ngon_ngu' => $data['ngon_ngu'],
            'kinh_nghiem' => $data['kinh_nghiem'],
            'danh_gia' => $data['danh_gia']
        ]);
    }

    public function updateNhanSu($id, $data)
    {
        $sql = "UPDATE nguoi_dung nd 
                JOIN huong_dan_vien hdv ON nd.id = hdv.nguoi_dung_id
                SET nd.ho_ten = :ho_ten,
                    nd.email = :email,
                    nd.so_dien_thoai = :so_dien_thoai,
                    hdv.ngon_ngu = :ngon_ngu,
                    hdv.kinh_nghiem = :kinh_nghiem,
                    hdv.danh_gia = :danh_gia
                WHERE hdv.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'ho_ten' => $data['ho_ten'],
            'email' => $data['email'],
            'so_dien_thoai' => $data['so_dien_thoai'],
            'ngon_ngu' => $data['ngon_ngu'],
            'kinh_nghiem' => $data['kinh_nghiem'],
            'danh_gia' => $data['danh_gia'],
            'id' => $id
        ]);
    }

    public function deleteNhanSu($id)
    {
        $stmt = $this->db->prepare("SELECT nguoi_dung_id FROM huong_dan_vien WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $nguoi_dung_id = $stmt->fetchColumn();

        $this->db->prepare("DELETE FROM huong_dan_vien WHERE id = :id")->execute(['id' => $id]);
        $this->db->prepare("DELETE FROM nguoi_dung WHERE id = :id")->execute(['id' => $nguoi_dung_id]);
    }
}
