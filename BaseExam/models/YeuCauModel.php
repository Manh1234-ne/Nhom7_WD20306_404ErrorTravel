<?php

require_once __DIR__ . '/../configs/database.php';

class YeuCauModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAll()
    {
        // ID tăng dần
        $sql = "SELECT * FROM yeu_cau_khach_dac_biet ORDER BY id ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $sql = "SELECT * FROM yeu_cau_khach_dac_biet WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        // Bỏ id_booking và tour_id
        $sql = "INSERT INTO yeu_cau_khach_dac_biet
                (ten_khach, loai_yeu_cau, mo_ta, trang_thai)
                VALUES (:ten_khach, :loai_yeu_cau, :mo_ta, 'cho_xu_ly')";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'ten_khach'    => $data['ten_khach'],
            'loai_yeu_cau' => $data['loai_yeu_cau'],
            'mo_ta'        => $data['mo_ta']
        ]);

        return $this->conn->lastInsertId();
    }

    public function update($id, $data)
    {
        $fields = [];
        $params = [];

        foreach ($data as $col => $val) {
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
}
