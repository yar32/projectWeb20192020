<?php


use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\View;

class UserController extends BaseController
{
    public function login(){
        return View::make("users.login");
    }

    public function register(){
        return View::make("users.register");
    }

    public function profile(){
        return View::make("users.profile");
    }
    public function backusers(){
        return View::make("backoffice.users.allusers");
    }
    public function roles(){
        return View::make("backoffice.users.roles");
    }
}