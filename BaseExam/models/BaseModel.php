<?php
require_once PATH_CONFIGS . 'helper.php';

class BaseModel
{
    protected $table;
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($data)
    {
        $keys = array_keys($data);
        $fields = implode(',', $keys);
        $placeholders = implode(',', array_fill(0, count($keys), '?'));
        $stmt = $this->db->prepare("INSERT INTO {$this->table} ($fields) VALUES ($placeholders)");
        $values = array_values($data);
        if ($stmt->execute($values)) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function update($id, $data)
    {
        $set = implode(',', array_map(fn($k) => "$k = ?", array_keys($data)));
        $stmt = $this->db->prepare("UPDATE {$this->table} SET $set WHERE id = ?");
        return $stmt->execute([...array_values($data), $id]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Thêm phương thức từ file 1
    // Kiểm tra xem bảng hiện tại có cột nào không
    public function hasColumn($columnName)
    {
        $sql = "SELECT COUNT(*) as c FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ? AND COLUMN_NAME = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$this->table, $columnName]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return isset($row['c']) && (int) $row['c'] > 0;
    }
}
