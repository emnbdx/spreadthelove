<?php

class Repository
{
    private $db = null;

    public function __construct()
    {
        $this->db = new PDO(
            'mysql:host=' . getenv('DbUrl') . ';dbname=' . getenv('DbName') . ';charset=utf8mb4',
            getenv('DbUser'),
            getenv('DbPassword')
        );
        $this->db->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
    }

    public function getReceivers() {
        $stmt = $this->db->prepare('
            SELECT *
            FROM receiver
            ORDER BY name
        ');
            
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getLoves($id) {
        $stmt = $this->db->prepare('
            SELECT *
            FROM love
            WHERE id_receiver = ?
        ');
            
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    public function insertLove($to, $from, $message) {
        $stmt = $this->db->prepare('
            INSERT INTO love (id_receiver, sender, content)
            VALUES (?, ?, ?)
        ');
        $stmt->execute([$to, $from, $message]);
    }
}
?>