<?php
//core model, things that will load on every page, header and footer / Login and Logout
class header extends router{
    private $menu0;
    private $menu1;
    private $menu2;
    public function __construct(){
        $this->loggedin();
        if($this->loggedin){ //list menu items from 1 starting from left to right
            $this->menu[0] = ''; //leave blank if you want nothing in that spot(needs to match up for loggin header)
            $this->menu[1] = '';
            $this->menu[2] = '';
        }
        else{
            $this->menu[0] = '';
            $this->menu[1] = '';
            $this->menu[2] = '';
        }
    }
}
