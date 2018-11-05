<?php

namespace app\Controllers;

Class HomeController {
    
    public function index() {
        echo view("home.index");
    }
}