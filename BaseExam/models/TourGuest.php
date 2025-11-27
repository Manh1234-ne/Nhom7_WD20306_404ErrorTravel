<?php

class TourGuest extends Database {

    private $table = "tour_guests";

    public function getByTour($tour_id) {
        $sql = "SELECT * FROM {$this->table} WHERE tour_id = ?";
        return $this->query($sql, [$tour_id]);
    }

    public function find($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        return $this->queryOne($sql, [$id]);
    }

    public function add(array $data) {

        // Set mặc định nếu thiếu tham số
        $data['trang_thai'] = $data['trang_thai'] ?? 'chua_den';
        $data['phong'] = $data['phong'] ?? '';

        $sql = "INSERT INTO {$this->table} 
            (tour_id, ho_ten, sdt, gioi_tinh, nam_sinh, yeu_cau, trang_thai, phong)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $params = [
            $data['tour_id'],
            $data['ho_ten'],
            $data['sdt'],
            $data['gioi_tinh'],
            $data['nam_sinh'],
            $data['yeu_cau'],
            $data['trang_thai'],
            $data['phong']
        ];

        return $this->insert($sql, $params);
    }

    public function updateCheckin($id, $status) {
        $sql = "UPDATE {$this->table} SET trang_thai = ? WHERE id = ?";
        return $this->update($sql, [$status, $id]);
    }

    public function updateRoom($id, $room) {
        $sql = "UPDATE {$this->table} SET phong = ? WHERE id = ?";
        return $this->update($sql, [$room, $id]);
    }

    public function export($tour_id) {
        return $this->getByTour($tour_id);
    }

        public function find($id) {
    $sql = "SELECT * FROM {$this->table} WHERE id = ?";
    return $this->queryOne($sql, [$id]);
    }

}