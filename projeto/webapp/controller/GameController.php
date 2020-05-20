<?php


use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Post;
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
        if(!Session::has("game"))
        {
            $game = new Game();
            Session::set("game",$game);
        }
        else{
            $game=Session::get("game");
        }
        if($game->playing==0){
            if($game->action=="dice"){
                $game->generatedices();
                if(!$game->checkplay()){
                    $game->finish();
                }
                else
                {
                    $game->action="number";
                    return View::make("game.game",["game"=>$game]);
                }
            }
            else
            {
                $game->numbersPlayer2->PCblockNumber($game->dice1->number+$game->dice2->number);
                if(!$game->checkplay()){
                    $game->finish();
                }
                else
                {
                    $game->action="number";
                    return View::make("game.game",["game"=>$game]);
                }
            }

        }
        return View::make("game.game",["game"=>$game]);
    }

    public function dice(){
        $game=Session::get("game");
        $game->generatedices();
        if(!$game->checkplay()){
            $game->nextplayer();
        }
        //TODO:change for Next player
        return Redirect::toRoute("game/game");
    }

    public function blocknums(){
        $game=Session::get("game");
        if(Post::get("player")=="player1"){
            $game->numbersPlayer1->blocknumbers(Post::get("numblock"));
            $game->action="dice";
        }
    }
}