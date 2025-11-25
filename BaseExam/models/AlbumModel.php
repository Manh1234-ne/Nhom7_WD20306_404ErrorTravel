<?php
// models/AlbumModel.php

class AlbumModel
{
    protected $db; // expecting a PDO instance or mysqli

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Create album and return inserted id
    public function createAlbum($title, $description)
    {
        $sql = "INSERT INTO albums (title, description) VALUES (:title, :description)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':title' => $title, ':description' => $description]);
        return $this->db->lastInsertId();
    }

    public function updateAlbum($id, $title, $description)
    {
        $sql = "UPDATE albums SET title=:title, description=:description WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':title' => $title, ':description' => $description, ':id' => $id]);
    }

    public function deleteAlbum($id)
    {
        $sql = "DELETE FROM albums WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function getAlbum($id)
    {
        $sql = "SELECT * FROM albums WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllAlbums()
    {
        $sql = "SELECT * FROM albums ORDER BY created_at DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Images
    public function addImage($album_id, $filename, $original_name, $mime, $size)
    {
        $sql = "INSERT INTO album_images (album_id, filename, original_name, mime, size) 
                VALUES (:album_id, :filename, :original_name, :mime, :size)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':album_id' => $album_id,
            ':filename' => $filename,
            ':original_name' => $original_name,
            ':mime' => $mime,
            ':size' => $size
        ]);
    }

    public function getImages($album_id)
    {
        $sql = "SELECT * FROM album_images WHERE album_id=:album_id ORDER BY id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':album_id' => $album_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteImage($id)
    {
        $sql = "DELETE FROM album_images WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
