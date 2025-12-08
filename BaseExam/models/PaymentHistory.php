<?php
class PaymentHistory
{
    protected $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
public function create($booking_id, $so_tien)
{
    $sql = "INSERT INTO lich_su_thanh_toan (booking_id, so_tien, ngay_thanh_toan) 
            VALUES (?, ?, NOW())";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([$booking_id, $so_tien]);
}

    public function getByBooking($booking_id)
    {
        $sql = "SELECT * FROM lich_su_thanh_toan WHERE booking_id = ? ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$booking_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
