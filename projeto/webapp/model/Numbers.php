<?php


class Numbers
{
    public $numbers;

    function Numbers(){
        $this->numbers=array(
            1=>false,
            2=>false,
            3=>false,
            4=>false,
            5=>false,
            6=>false,
            7=>false,
            8=>false,
            9=>false,
        );
    }


    public function blocknumbers($numbers){
        foreach ($numbers as $number){
            $this->numbers[$number]=true;
        }
    }

    public function PCblockNumber($totaldice){
        foreach (array_reverse($this->numbers,true) as $number=>$status){
            if($status==false){

            }
        }
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