<?php
class HomeView
{
    private HomeController $controller;
    private string $template;

    public function __construct(HomeController $controller)
    {
        $this->controller = $controller;
        $this->template = DIR_TEMPLATE . "home.php";
    }

//    public function render(): void
//    {
//        $data = $this->controller->getLastGames();
//        require($this->template);
//    }
}
