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
            //Session::remove("game");
        }
        if($game->playing==-1){

            if($game->action=="dice"){
                $game->generatedices();
                if(!$game->canplay()){
                    $game->finish();
                    //Add to History
                    $history= new Historygame();
                    if($game->totalPL1 < $game->totalPL2)
                    {
                        $history->gamestate=1;
                        $history->points=($game->numbersPlayer1->sumBlocked()-$game->numbersPlayer2->sumBlocked());
                    }

                    if($game->totalPL1 > $game->totalPL2)
                    {
                        $history->gamestate=-1;
                        $history->points=0;
                    }
                    if($game->totalPL1 == $game->totalPL2)
                    {
                        $history->gamestate=0;
                        $history->points=0;
                    }
                    $history->user_id=Session::get("userid");
                    if($history->is_valid()){
                        $history->save();
                    }



                    Session::remove("game");
                    return View::make("game.game",["game"=>$game]);
                }
                else{
                    //View::make("game.game",["game"=>$game]);
                    //sleep(5);
                    //return Redirect::toRoute("game/game");
                }
            }
            if($game->action=="number")
            {
                $game->numbersPlayer2->PCblockNumber($game->dice1->number+$game->dice2->number);
                $game->action="dice";
                //View::make("game.game",["game"=>$game]);
                //sleep(5);
                //return Redirect::toRoute("game/game");
            }
            return View::make("game.game",["game"=>$game]);
        }
        //If erro in finish game
        if(Session::has("game") && $game->playing==null){
            Session::remove("game");
            return Redirect::toRoute("game/game");
        }
        return View::make("game.game",["game"=>$game]);
    }

    public function dice(){
        $game=Session::get("game");
        $game->generatedices();
        if(!$game->canplay()){
            $game->nextplayer();
        }
        return Redirect::toRoute("game/game");
    }

    //Ajax
    public function blocknums(){
        $game=Session::get("game");
        if(Post::get("player")=="player1"){
            $game->numbersPlayer1->blocknumbers(Post::get("numblock"));
            $game->action="dice";
        }
    }
}