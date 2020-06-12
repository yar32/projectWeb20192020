<?php


use ActiveRecord\Model;

class Historygame extends Model
{
    static $belongs_to = array(array('user'));
    static $before_create = array('insertDate'); # new records only
    static $validates_presence_of = array(
        array('points'),
        array('gamestate'),
    );
    static $validates_numericality_of = array(
        array('points', 'only_integer' => true),
        array('gamestate', 'only_integer' => true),
    );
    //Todo: Format
    public function insertDate(){
        $this->date=date("Y-m-d H:i:s");
        //\Tracy\Debugger::barDump($this);
        //die();
    }
}