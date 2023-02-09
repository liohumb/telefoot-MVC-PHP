<?php
class HomeModel
{
    public PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
}
