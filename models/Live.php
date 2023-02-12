<?php
class Live {
    private PDO $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=localhost:3306;dbname=telefoot", "root", "rootroot");
    }

    public function getChannels(): false|array
    {
        $query = "SELECT name, image FROM channels";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getReplays(): false|array
    {
        $query = "SELECT name, image FROM replay";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClubs(): false|array
    {
        $query = "SELECT name, image, category FROM clubs ORDER BY category";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $clubs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $mappedClubs = array();
        foreach ($clubs as $club) {
            $category = $club["category"];
            if (!array_key_exists($category, $mappedClubs)) {
                $mappedClubs[$category] = array();
            }
            $mappedClubs[$category][] = $club;
        }

        return $mappedClubs;
    }
}