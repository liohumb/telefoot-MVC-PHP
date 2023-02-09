<?php
class HomeController
{
    private HomeModel $model;

    public function __construct(HomeModel $model)
    {
        $this->model = $model;
    }

//    public function getLastGames()
//    {
//        $query = $this->model->db->query("SELECT * FROM games ORDER BY id DESC LIMIT 0,3");
//        $games = $query->fetchAll(PDO::FETCH_ASSOC);
//
//        return $games;
//    }
}