<?php
require_once 'BaseModel.php';

class NhanSu extends BaseModel
{
    protected $table = 'huong_dan_vien';

    public function getAllWithNguoiDung()
    {
        $sql = "SELECT hdv.*, nd.ho_ten, nd.email, nd.so_dien_thoai, nd.vai_tro
                FROM huong_dan_vien hdv
                JOIN nguoi_dung nd ON hdv.nguoi_dung_id = nd.id";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findWithNguoiDung($id)
    {
        $sql = "SELECT hdv.*, nd.ho_ten, nd.email, nd.so_dien_thoai, nd.vai_tro
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
                                     VALUES (:ho_ten, :email, :so_dien_thoai, :ten_dang_nhap, :mat_khau, :vai_tro)");
        $stmt1->execute([
            'ho_ten' => $data['ho_ten'],
            'email' => $data['email'],
            'so_dien_thoai' => $data['so_dien_thoai'],
            'ten_dang_nhap' => $data['email'],
            'mat_khau' => password_hash('123456', PASSWORD_DEFAULT),
            'vai_tro' => $data['vai_tro']
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
        $fields = "nd.ho_ten = :ho_ten,
                   nd.email = :email,
                   nd.so_dien_thoai = :so_dien_thoai,
                   hdv.ngon_ngu = :ngon_ngu,
                   hdv.kinh_nghiem = :kinh_nghiem,
                   hdv.danh_gia = :danh_gia";

        // Nếu có vai trò thì update
        if (isset($data['vai_tro'])) {
            $fields .= ", nd.vai_tro = :vai_tro";
        }

        $sql = "UPDATE nguoi_dung nd 
                JOIN huong_dan_vien hdv ON nd.id = hdv.nguoi_dung_id
                SET $fields
                WHERE hdv.id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(array_merge($data, ['id' => $id]));
    }

    public function deleteNhanSu($id)
    {
        $stmt = $this->db->prepare("SELECT nguoi_dung_id FROM huong_dan_vien WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $nguoi_dung_id = $stmt->fetchColumn();

        $this->db->prepare("DELETE FROM huong_dan_vien WHERE id = :id")->execute(['id' => $id]);
        $this->db->prepare("DELETE FROM nguoi_dung WHERE id = :id")->execute(['id' => $nguoi_dung_id]);
    }

    public function getHDVByLoaiTour($loai_tour)
    {
        // Chuẩn hóa key: "Trong nước" -> "trong_nuoc"
        $loai_key = strtolower(str_replace(' ', '_', $loai_tour));

        $sql = "SELECT hdv.*, nd.ho_ten, nd.email, nd.so_dien_thoai
            FROM huong_dan_vien hdv
            JOIN nguoi_dung nd ON hdv.nguoi_dung_id = nd.id
            WHERE hdv.loai_hdv = :loai OR hdv.loai_hdv = 'ca_hai'";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['loai' => $loai_key]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Nếu có HDV trong DB thì trả về
        if (!empty($result)) {
            return $result;
        }

        // Nếu không có, fallback sang hard-code
        $map = [
            'trong_nuoc' => [
                [
                    'id' => 0,
                    'ho_ten' => 'Nguyễn Văn A',
                    'so_dien_thoai' => '0909 111 222',
                    'email' => 'hdv-trongnuoc@travel.test',
                    'ngon_ngu' => 'Tiếng Việt, Tiếng Anh',
                    'kinh_nghiem' => '3 năm',
                    'danh_gia' => '4.5'
                ]
            ],
            'quoc_te' => [
                [
                    'id' => 0,
                    'ho_ten' => 'Trần Thị B',
                    'so_dien_thoai' => '0909 222 333',
                    'email' => 'hdv-quocte@travel.test',
                    'ngon_ngu' => 'Tiếng Anh, Tiếng Nhật',
                    'kinh_nghiem' => '6 năm',
                    'danh_gia' => '4.9'
                ]
            ],
            'yeu_cau' => [
                [
                    'id' => 0,
                    'ho_ten' => 'Phạm Minh C',
                    'so_dien_thoai' => '0909 333 444',
                    'email' => 'hdv-yeucau@travel.test',
                    'ngon_ngu' => 'Tiếng Việt, Tiếng Trung',
                    'kinh_nghiem' => '4 năm',
                    'danh_gia' => '4.7'
                ]
            ]
        ];

        return $map[$loai_key] ?? [
            [
                'id' => 0,
                'ho_ten' => 'Hướng dẫn viên mặc định',
                'so_dien_thoai' => '0999 888 777',
                'email' => 'default@travel.test',
                'ngon_ngu' => 'Tiếng Việt',
                'kinh_nghiem' => '2 năm',
                'danh_gia' => '4.0'
            ]
        ];
    }


}
