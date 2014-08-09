<?php
class router{
    public $controller;
    public $model;
    public $_GET;
    public $_SESSION;
    public $page;
    public $loggedin;

    protected function loggedin(){
        if(isset($_SESSION['ID'])){
            $this->loggedin = true;
        }
        else{
            $this->loggedin = false;
        }
    }

    public function __construct($page){
        $this->page = $page;
        if($this->page == null){
            $this->page = 'home';
        }
        if(isset($_SESSION['ID'])){
        $this->loggedin = true;
        }
        else{
            $this->loggedin = false;
        }
        if($this->loggedin){
            $this->page = "view/" . $this->page . ".php";
            $this->controller = "controller/" . $this->page . ".php";
            $this->model = "model/" . $this->page . ".php";
        }
        else{
            $this->page = "view/home.php";
        }
    }
}

?>