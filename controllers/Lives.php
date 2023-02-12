<?php
class Lives {
    private Live $live;

    public function __construct() {
        require_once("models/Live.php");
        $this->live = new Live();
    }

    public function getData(): array
    {
        $data = [
            "channels" => $this->live->getChannels(),
            "replay" => $this->live->getReplays(),
            "clubs" => [],
        ];

        $clubs = $this->live->getClubs();
        foreach ($clubs as $category => $clubCategory) {
            $data["clubs"][$category] = array_slice($clubCategory, 0, 15);
        }

        return $data;
    }
}