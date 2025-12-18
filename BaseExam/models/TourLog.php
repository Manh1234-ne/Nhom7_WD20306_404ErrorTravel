<?php
require_once 'BaseModel.php';

class TourLog extends BaseModel
{
    protected $table = 'nhat_ky_tour';

    /**
     * Tạo nhật ký tour
     *
     * @param int $booking_id
     * @param int|null $lich_khoi_hanh_id
     * @param int|null $hdv_id
     * @param string|null $loai_hanh_dong
     * @param string|null $noi_dung
     * @return bool
     */
    public function create(
        int $booking_id,
        ?int $lich_khoi_hanh_id = null,
        ?int $hdv_id = null,
        ?string $loai_hanh_dong = null,
        ?string $noi_dung = null
    ): bool {
        $sql = "INSERT INTO {$this->table} 
                (booking_id, lich_khoi_hanh_id, huong_dan_vien_id, loai_hanh_dong, ngay_ghi, noi_dung)
                VALUES (:booking_id, :lich_khoi_hanh_id, :hdv_id, :loai_hanh_dong, NOW(), :noi_dung)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':booking_id'        => $booking_id,
            ':lich_khoi_hanh_id' => $lich_khoi_hanh_id !== null ? (int)$lich_khoi_hanh_id : null,
            ':hdv_id'            => $hdv_id !== null ? (int)$hdv_id : null,
            ':loai_hanh_dong'    => $loai_hanh_dong,
            ':noi_dung'          => $noi_dung
        ]);
    }

    /**
     * Lấy tất cả nhật ký theo booking
     *
     * @param int $booking_id
     * @return array
     */
    public function getByBooking(int $booking_id): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE booking_id = :booking_id ORDER BY ngay_ghi DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':booking_id' => $booking_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
