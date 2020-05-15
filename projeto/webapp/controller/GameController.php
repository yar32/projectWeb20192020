<?php


use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;

class GameController extends BaseController
{
    public function index(){
        if(!Session::has("userid"))
        {
            return Redirect::toRoute("home/");
        }


        return View::make("game.index");
    }

    public function game(){
        if(!Session::has("userid"))
        {
            return Redirect::toRoute("home/");
        }
        return View::make("game.game");
    }

}