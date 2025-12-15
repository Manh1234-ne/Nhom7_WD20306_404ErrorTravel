<?php

require_once __DIR__ . '/../configs/database.php';

class YeuCauModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAll($filters = [])
    {
        // Tạm thời không dùng JOIN cho đến khi database được cập nhật
        $sql = "SELECT * FROM yeu_cau_khach_dac_biet WHERE 1=1";
        $params = [];

        // Tìm kiếm theo tên khách
        if (!empty($filters['search'])) {
            $sql .= " AND ten_khach LIKE :search";
            $params[':search'] = '%' . $filters['search'] . '%';
        }

        // Lọc theo loại yêu cầu
        if (!empty($filters['loai'])) {
            $loaiYeuCauMapping = [
                'Ăn chay' => 'an_chay',
                'Yêu cầu về dị ứng' => 'di_ung',
                'Yêu cầu về bệnh lý' => 'benh_ly',
                'Yêu cầu về phòng nghỉ' => 'yeu_cau_phong',
                'Yêu cầu phương tiện di chuyển' => 'yeu_cau_di_chuyen',
                'Yêu cầu về ăn uống' => 'yeu_cau_an_uong',
                'Khác' => 'khac'
            ];
            $loaiEnum = $loaiYeuCauMapping[$filters['loai']] ?? $filters['loai'];
            $sql .= " AND loai_yeu_cau = :loai";
            $params[':loai'] = $loaiEnum;
        }

        // Lọc theo trạng thái
        if (!empty($filters['trang_thai'])) {
            $trangThaiMapping = [
                'cho_xu_ly' => 'cho_xu_ly',
                'dang_xu_ly' => 'dang_xu_ly',
                'da_dap_ung' => 'hoan_thanh',
                'khong_the_dap_ung' => 'khong_the_dap_ung'
            ];
            $trangThaiEnum = $trangThaiMapping[$filters['trang_thai']] ?? $filters['trang_thai'];
            $sql .= " AND trang_thai = :trang_thai";
            $params[':trang_thai'] = $trangThaiEnum;
        }

        $sql .= " ORDER BY id DESC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Convert enum values back to display text
        $loaiYeuCauMapping = [
            'an_chay' => 'Ăn chay',
            'di_ung' => 'Yêu cầu về dị ứng',
            'benh_ly' => 'Yêu cầu về bệnh lý', 
            'yeu_cau_phong' => 'Yêu cầu về phòng nghỉ',
            'yeu_cau_di_chuyen' => 'Yêu cầu phương tiện di chuyển',
            'yeu_cau_an_uong' => 'Yêu cầu về ăn uống',
            'khac' => 'Khác'
        ];

        $trangThaiMapping = [
            'cho_xu_ly' => 'cho_xu_ly',
            'dang_xu_ly' => 'dang_xu_ly', 
            'hoan_thanh' => 'da_dap_ung',
            'khong_the_dap_ung' => 'khong_the_dap_ung'
        ];

        foreach ($results as &$row) {
            $row['loai_yeu_cau'] = $loaiYeuCauMapping[$row['loai_yeu_cau']] ?? $row['loai_yeu_cau'];
            $row['trang_thai'] = $trangThaiMapping[$row['trang_thai']] ?? $row['trang_thai'];
        }
        
        return $results;
    }

    public function find($id)
    {
        // Tạm thời không dùng JOIN cho đến khi database được cập nhật
        $sql = "SELECT * FROM yeu_cau_khach_dac_biet WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            // Convert enum values back to display text
            $loaiYeuCauMapping = [
                'an_chay' => 'Ăn chay',
                'di_ung' => 'Yêu cầu về dị ứng',
                'benh_ly' => 'Yêu cầu về bệnh lý',
                'yeu_cau_phong' => 'Yêu cầu về phòng nghỉ',
                'yeu_cau_di_chuyen' => 'Yêu cầu phương tiện di chuyển',
                'yeu_cau_an_uong' => 'Yêu cầu về ăn uống',
                'khac' => 'Khác'
            ];

            $trangThaiMapping = [
                'cho_xu_ly' => 'cho_xu_ly',
                'dang_xu_ly' => 'dang_xu_ly',
                'hoan_thanh' => 'da_dap_ung', 
                'khong_the_dap_ung' => 'khong_the_dap_ung'
            ];

            $result['loai_yeu_cau'] = $loaiYeuCauMapping[$result['loai_yeu_cau']] ?? $result['loai_yeu_cau'];
            $result['trang_thai'] = $trangThaiMapping[$result['trang_thai']] ?? $result['trang_thai'];
        }
        
        return $result;
    }

    public function create($data)
    {
        // Mapping từ text sang enum values
        $loaiYeuCauMapping = [
            'Ăn chay' => 'an_chay',
            'Yêu cầu về dị ứng' => 'di_ung', 
            'Yêu cầu về bệnh lý' => 'benh_ly',
            'Yêu cầu về phòng nghỉ' => 'yeu_cau_phong',
            'Yêu cầu phương tiện di chuyển' => 'yeu_cau_di_chuyen',
            'Yêu cầu về ăn uống' => 'yeu_cau_an_uong',
            'Khác' => 'khac'
        ];

        $loaiYeuCau = $loaiYeuCauMapping[$data['loai_yeu_cau']] ?? 'khac';

        $sql = "INSERT INTO yeu_cau_khach_dac_biet
                (ten_khach, loai_yeu_cau, mo_ta, trang_thai)
                VALUES (:ten_khach, :loai_yeu_cau, :mo_ta, 'cho_xu_ly')";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'ten_khach'    => $data['ten_khach'],
            'loai_yeu_cau' => $loaiYeuCau,
            'mo_ta'        => $data['mo_ta']
        ]);

        return $this->conn->lastInsertId();
    }

    public function update($id, $data)
    {
        // Mapping từ display text sang enum values
        $loaiYeuCauMapping = [
            'Ăn chay' => 'an_chay',
            'Yêu cầu về dị ứng' => 'di_ung',
            'Yêu cầu về bệnh lý' => 'benh_ly',
            'Yêu cầu về phòng nghỉ' => 'yeu_cau_phong', 
            'Yêu cầu phương tiện di chuyển' => 'yeu_cau_di_chuyen',
            'Yêu cầu về ăn uống' => 'yeu_cau_an_uong',
            'Khác' => 'khac'
        ];

        $trangThaiMapping = [
            'cho_xu_ly' => 'cho_xu_ly',
            'dang_xu_ly' => 'dang_xu_ly',
            'da_dap_ung' => 'hoan_thanh',
            'khong_the_dap_ung' => 'khong_the_dap_ung'
        ];

        $fields = [];
        $params = [];

        foreach ($data as $col => $val) {
            if ($col === 'loai_yeu_cau' && isset($loaiYeuCauMapping[$val])) {
                $val = $loaiYeuCauMapping[$val];
            }
            if ($col === 'trang_thai' && isset($trangThaiMapping[$val])) {
                $val = $trangThaiMapping[$val];
            }
            
            $fields[] = "$col = :$col";
            $params[":$col"] = $val;
        }

        $params[':id'] = $id;

        $sql = "UPDATE yeu_cau_khach_dac_biet SET " . implode(', ', $fields) . " WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM yeu_cau_khach_dac_biet WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Lấy nhật ký xử lý
    public function getNhatKy($id_yeu_cau)
    {
        $sql = "SELECT * FROM nhat_ky_xu_ly_yeu_cau WHERE id_yeu_cau = ? ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id_yeu_cau]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lưu nhật ký xử lý
    public function luuNhatKy($data)
    {
        $sql = "INSERT INTO nhat_ky_xu_ly_yeu_cau 
                (id_yeu_cau, nguoi_xu_ly, ghi_chu, trang_thai_cu, trang_thai_moi) 
                VALUES (:id_yeu_cau, :nguoi_xu_ly, :ghi_chu, :trang_thai_cu, :trang_thai_moi)";
        
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'id_yeu_cau' => $data['id_yeu_cau'],
            'nguoi_xu_ly' => $data['nguoi_xu_ly'],
            'ghi_chu' => $data['ghi_chu'],
            'trang_thai_cu' => $data['trang_thai_cu'],
            'trang_thai_moi' => $data['trang_thai_moi']
        ]);
    }

    // Lấy danh sách tour để chọn
    public function getAllTours()
    {
        $sql = "SELECT id, ten_tour FROM tour ORDER BY ten_tour";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách booking để chọn
    public function getAllBookings()
    {
        $sql = "SELECT d.id, d.ten_khach, d.so_dien_thoai, t.ten_tour, d.ngay_khoi_hanh 
                FROM dat_tour d 
                LEFT JOIN tour t ON d.tour_id = t.id 
                ORDER BY d.created_at DESC LIMIT 50";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tạo yêu cầu từ booking
    public function createFromBooking($bookingId, $data)
    {
        // Lấy thông tin booking
        $booking = $this->getBookingInfo($bookingId);
        if (!$booking) {
            throw new Exception('Booking không tồn tại');
        }

        $loaiYeuCauMapping = [
            'Ăn chay' => 'an_chay',
            'Yêu cầu về dị ứng' => 'di_ung', 
            'Yêu cầu về bệnh lý' => 'benh_ly',
            'Yêu cầu về phòng nghỉ' => 'yeu_cau_phong',
            'Yêu cầu phương tiện di chuyển' => 'yeu_cau_di_chuyen',
            'Yêu cầu về ăn uống' => 'yeu_cau_an_uong',
            'Khác' => 'khac'
        ];

        $loaiYeuCau = $loaiYeuCauMapping[$data['loai_yeu_cau']] ?? 'khac';

        $sql = "INSERT INTO yeu_cau_khach_dac_biet
                (booking_id, tour_id, ten_khach, loai_yeu_cau, mo_ta, trang_thai)
                VALUES (:booking_id, :tour_id, :ten_khach, :loai_yeu_cau, :mo_ta, 'cho_xu_ly')";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'booking_id' => $bookingId,
            'tour_id' => $booking['tour_id'],
            'ten_khach' => $booking['ten_khach'],
            'loai_yeu_cau' => $loaiYeuCau,
            'mo_ta' => $data['mo_ta']
        ]);

        return $this->conn->lastInsertId();
    }

    // Lấy thông tin booking
    private function getBookingInfo($bookingId)
    {
        $sql = "SELECT * FROM dat_tour WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$bookingId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
