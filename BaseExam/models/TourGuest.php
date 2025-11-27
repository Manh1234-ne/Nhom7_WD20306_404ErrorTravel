<?php
class TourGuest
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getByTour($tour_id)
    {
        $sql = "SELECT * FROM tour_guest WHERE tour_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$tour_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($data)
    {
        $sql = "INSERT INTO tour_guest (tour_id, ten_khach, sdt, cccd, phong, trang_thai)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $data['tour_id'],
            $data['ten_khach'],
            $data['sdt'],
            $data['cccd'],
            $data['phong'] ?? "",
            0
        ]);

        return $this->conn->lastInsertId();
    }

    public function find($id)
    {
        $sql = "SELECT * FROM tour_guest WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateCheckin($id, $status)
    {
        $sql = "UPDATE tour_guest SET trang_thai = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$status, $id]);
    }

    public function updateRoom($id, $room)
    {
        $sql = "UPDATE tour_guest SET phong = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$room, $id]);
    }

    public function export($tour_id)
    {
        $sql = "SELECT * FROM tour_guest WHERE tour_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$tour_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
