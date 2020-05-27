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

    //Block numberes
    public function blocknumbers($numbers){
        foreach ($numbers as $number){
            $this->numbers[$number]=true;
        }
    }
    // Computer intelligence
    public function PCblockNumber($totaldice){
        $max=0;
        $size=1;
        $UnblockedNums=$this->getUnblockedNums();
        $allcombinations=$this->getallcombinations($UnblockedNums);
        $possibilityPlay = array();
        foreach ($allcombinations as $result){
            if(array_sum($result)==$totaldice)
                array_push($possibilityPlay,$result);
        }
        $filteredpossibilitis=array();

        do{
            $again=false;
            foreach ($possibilityPlay as $result){
                if ($size==count($result)){
                    array_push($filteredpossibilitis,$result);
                }
            }
            if(count($filteredpossibilitis)==0){
                $again=true;
                $size++;
            }
        }while($again);

        //print_r($filteredpossibilitis);

        $forBlock=null;
        foreach ($filteredpossibilitis as $key=>$array){
            foreach ($array as $num){
                if($max<$num){
                    $max=$num;
                    $forBlock=$array;
                }
            }
        }

        /*print_r($forBlock);
        die();*/
        $this->blocknumbers($forBlock);
    }

    //Get all sumed possibilitis for play
    public function sum_possibilitis() {
        // initialize by adding the empty set
        $UnblockedNums=$this->getUnblockedNums();
        $allcombinations=$this->getallcombinations($UnblockedNums);

        $sums = array();
        foreach ($allcombinations as $result){
            array_push($sums,array_sum($result));
        }
        return array_unique($sums);
    }
    //Get all summed unblocked numbers
    public function sumUnblocked(){
        $sum=0;
        foreach ($this->numbers as $num=>$status){
            if($status==false){
                $sum+=$num;
            }
        }
        return $sum;
    }
    //Get all summed blocked numbers
    public function sumBlocked(){
        $sum=0;
        foreach ($this->numbers as $num=>$status){
            if($status==true){
                $sum+=$num;
            }
        }
        return $sum;
    }

    //Get all combinations possible make
    private function getallcombinations($nums){
        $results = array(array( ));
        foreach ($nums as $element)
            foreach ($results as $combination)
                array_push($results, array_merge(array($element), $combination));

        return $results;
    }

    //Get all unblocked numbers
    private function getUnblockedNums(){
        $UnblockedNums=array();
        foreach ($this->numbers as $key=>$blocked){
            if(!$blocked){
                array_push($UnblockedNums,$key);
            }
        }
        return $UnblockedNums;
    }
}