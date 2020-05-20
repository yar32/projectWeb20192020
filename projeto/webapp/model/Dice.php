<?php


class Dice
{
    public $number;

    function Dice(){
        $this->number=1;
    }

    public function generate(){
        $this->number=rand(1,6);
    }

}