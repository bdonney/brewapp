<?php
//core model, things that will load on every page, header and footer / Login and Logout
class header extends router{
    private $menu0;
    private $menu1;
    private $menu2;
    public function __construct(){
        $this->loggedin();
        if($this->loggedin){ //list menu items from 1 starting from right to left
            $this->menu[0] = ''; //leave blank if you want nothing in that spot(needs to match up for loggin header)
            $this->menu[1] = '';
            $this->menu[2] = '';
        }
        else{
            $this->menu[0] = '<li><button class="btn btn-primary" data-toggle="modal" data-target="#LogInModal"> Login </button></li>';
            $this->menu[1] = '<li> <button class="btn btn-primary" data-toggle="modal" data-target="#SignUpModal"> Signup </button>&nbsp;&nbsp;</li>';
        }
    }
}
//  This Class routes all my pages and gathers my needed controller and model files.
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
