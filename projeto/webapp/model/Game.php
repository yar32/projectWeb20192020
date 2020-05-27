<?php


use ArmoredCore\WebObjects\Session;

class Game
{
    public $dice1;
    public $dice2;
    public $numbersPlayer1;
    public $numbersPlayer2;
    public $action;
    public $playing;
    public $totalPL1;
    public $totalPL2;
    //Start game
    public function Game()
    {
        $this->action="dice";
        $this->playing=1;
        $this->dice1=new Dice();
        $this->dice2=new Dice();
        $this->numbersPlayer1 = new Numbers();
        $this->numbersPlayer2 = new Numbers();
        $this->totalPL1=null;
        $this->totalPL2=null;
    }



    //Get dice value and total dice
    public function generatedices(){
        $this->dice1->generate();
        $this->dice2->generate();
        $this->action="number";
    }
    //Validate if can play
    public function canplay(){
        if($this->playing==1)
        {
            //Get all sum possibilitis
            $totalUnblockedNums=$this->numbersPlayer1->sum_possibilitis();
            $totalDices=$this->dice1->number + $this->dice2->number;
            //Search in possibilitis if have sum igual to sum of dices
            $posibility=array_search($totalDices,$totalUnblockedNums);

        }
        else{
            $totalUnblockedNums=$this->numbersPlayer2->sum_possibilitis();
            $totalDices=$this->dice1->number + $this->dice2->number;
            $posibility=array_search($totalDices,$totalUnblockedNums);
        }
        if($posibility==null){
            return false;
        }
        return true;
    }
    //Go to next player
    public function nextplayer(){
        /// -1 : Computer
        /// 1 : Player 1
        /// 2 : Player 2 (no implemented)
        $this->playing=-1;
    }
    //Finish game
    public function finish(){
        $this->action=null;
        $this->playing=null;
        $this->totalPL1=$this->numbersPlayer1->sumUnblocked();
        $this->totalPL2=$this->numbersPlayer2->sumUnblocked();

    }

}