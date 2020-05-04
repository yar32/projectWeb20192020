<?php


use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\View;

class GameController extends BaseController
{
    public function index(){
        return View::make("game.index");
    }

    public function game(){
        return View::make("game.game");
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