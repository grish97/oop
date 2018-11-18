<?php 

namespace app\Controllers;

Use Core\BaseController;

Class UserController extends BaseController {
    
    public function login() {
        return view("user.login");
    }

    public function loginSubmit() {
        echo "logining";
    }

    public function register() {
        
        return view("user.register");
    }

    public function registerSubmite() {
        $this->validate($_POST, ["name" => "required|max:25|min:3",
            "last_name" => "required|max:25|min:3",
            "email" => "required|max:25|min:3|email",
            "password" =>"required|max:25|min:3|comfirmed"
            ]);
    }
}