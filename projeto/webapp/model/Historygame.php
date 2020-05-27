<?php


use ActiveRecord\Model;

class Historygame extends Model
{
    static $before_create = array('insert');
    static $validates_presence_of = array(
        array('points'),
        array('gamestate'),
    );
    static $validates_numericality_of = array(
        array('points', 'only_integer' => true),
        array('gamestate', 'only_integer' => true),
    );
    //Todo: Format
    public function insert(){
        $this->date=date("Y-m-d H:i:s");
    }
}