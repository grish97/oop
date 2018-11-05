<?php 

namespace app\Controllers;

Class UserController {
    
    public function login() {
        echo view("user.login");
    }

    public function register() {
        
        echo view("user.register");
    }
}