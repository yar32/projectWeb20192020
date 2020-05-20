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
    //Start game
    public function Game()
    {
        $this->action="dice";
        $this->playing=1;
        $this->dice1=new Dice();
        $this->dice2=new Dice();
        $this->numbersPlayer1 = new Numbers();
        $this->numbersPlayer2 = new Numbers();
    }



    //Get dice value and total dice
    public function generatedices(){
        $this->dice1->generate();
        $this->dice2->generate();
        $this->action="number";
    }

    public function checkplay(){
        $UnblockedNums=array();
        foreach ($this->numbersPlayer1->numbers as $key=>$blocked){
            if(!$blocked){
                array_push($UnblockedNums,$key);
            }
        }
        $totalDices=$this->dice1->number + $this->dice2->number;
        $totalUnblockedNums=$this->sum_possiblilitis($UnblockedNums);
        $posibility=array_search($totalDices,$totalUnblockedNums);

        if($posibility==null){
            return false;
        }
        return true;


    }

    public function nextplayer(){
        $this->playing=0;
    }
    //Finish game
    public function finish(){

    }



    private function sum_possiblilitis($array) {
        // initialize by adding the empty set
        $results = array(array( ));

        foreach ($array as $element)
            foreach ($results as $combination)
                array_push($results, array_merge(array($element), $combination));

        $sums = array();
        foreach ($results as $result){
            array_push($sums,array_sum($result));
        }
        return array_unique($sums);
    }
}