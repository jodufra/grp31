<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 05-01-2015
 * Time: 19:15
 */

class MovesProbabilities {
    
    private $ones = true;
    private $twos = true;
    private $threes = true;
    private $fours = true;
    private $fives = true;
    private $sixes = true;
    private $threeOfKind = true;
    private $fourOfKind = true;
    private $fullHouse = true;
    private $smallStraight = true;
    private $largeStraigh = true;
    private $chance = true;
    private $yahtzee = true;
    private $imports;

    public function __construct(){
        $this->imports = new Imports();
        $this->ones = true;
        $this->twos = true;
        $this->threes = true;
        $this->fours = true;
        $this->fives = true;
        $this->sixes = true;
        $this->threeOfKind = true;
        $this->fourOfKind = true;
        $this->fullHouse = true;
        $this->smallStraight = true;
        $this->largeStraigh = true;
        $this->chance = true;
        $this->yahtzee = true;
    }

    //----FUNCTIONS-----

    public function getOnes($dices){
        return $this->imports->getHowManyMatches($dices, 1);
    }
    public function getTwos($dices){
        return $this->imports->getHowManyMatches($dices, 2);
    }
    public function getThrees($dices){
        return $this->imports->getHowManyMatches($dices, 3);
    }
    public function getFours($dices){
        return $this->imports->getHowManyMatches($dices, 4);
    }
    public function getFives($dices) {
        return $this->imports->getHowManyMatches($dices, 5);
    }
    public function getSixes($dices) {
        return $this->imports->getHowManyMatches($dices, 6);
    }
    public function getProbThreeOfKind($dices) {
        $matches = [];
        $value = 0;
        for($i = 0; $i<count($dices); $i++){
            $value=$dices[$i];
            if($value > 3)
                array_push($matches, $this->imports->getHowManyMatches($dices, $value));
        }
        if(count($matches) >= 1){
            $more_matches = max($matches);
            if($more_matches >= 2){
                $difference = 5 - $more_matches;
                if($difference <= 2) //Tem three of a kind
                    return 100;
                else return 16.666666667; //Se chegar aqui apenas pode ser esta possibilidade
            }
        }
        return 0;
    }
    public function getProbFourOfKind($dices) {
        $matches = [];
        $value = 0;
        for($i = 0; $i<count($dices); $i++){
            $value=$dices[$i];
            if($value > 3)
                array_push($matches, $this->imports->getHowManyMatches($dices, $value));
        }
        if(count($matches)>= 1){
            $more_matches = max($matches);
            if($more_matches >= 2){
                $difference = 5 - $more_matches;
                if($difference <= 1) //Tem four of a kind
                    return 100;
                else if($difference == 2)
                    return 16.666666667;
                else return 2.777777778; //Se chegar aqui apenas pode ser esta possibilidade
            }
        }
        return 0;
    }
    public function getProbYahtzee($dices) {
        $matches = [];
        $value = 0;
        for($i = 0; $i<count($dices); $i++){
            $value=$dices[$i];
            if($value > 3)
                array_push($matches, $this->imports->getHowManyMatches($dices, $value));
        }
        if(count($matches) >= 1){
            $more_matches = max($matches);
            if($more_matches >= 2){
                $difference = 5 - $more_matches;
                if($difference == 0) //Tem Yahtzee
                    return 100;
                else if($difference == 1)
                    return 16.666666667;
                else if($difference == 2)
                    return 2.777777778;
                else return 0; //Se chegar aqui apenas pode ser esta possibilidade
            }
        }
        return 0;
    }
    public function getProbFullHouse($dices) {
        $r_dices = $this->imports->getRepeatedDices($dices);
        $length = count($r_dices);

        if($length >= 2) {
            if($r_dices[0] !== $r_dices[$length-1]){
                $r_dices_splitted = $this->imports->splitArray($r_dices, $r_dices[$length-1]);
                if((count($r_dices_splitted['first']) ==  2 && count($r_dices_splitted['second']) == 3)||(count($r_dices_splitted['first']) ==  3 && count($r_dices_splitted['second']) == 2)) //already have a full house
                    return 100;
                else return 33.333333333;
            }
            else{
                if($length >= 3)
                    return 13.888888889;
                else return 2.314814815; //length == 2
            }
        }
        else return 0;

    }
    public function getProbSmallStraigth($dices){
        $no_repeated_dices = $this->imports->takeOfRepeatedNumbers($dices); //it's already sorted the array
        $length = count($no_repeated_dices);
        if($length > 1){
            $cleaned_array = $this->imports->takeOfBigDifferenceNumbers($no_repeated_dices, 4);
            $new_length = count($cleaned_array);
            if($new_length > 1){
                $difference = 4-$new_length;
                if($difference <= 0) //Have sequence
                    return 100;
                else{
                    $result = $this->imports->fatorial($difference);
                    if($difference == 2)
                        return $result/36*100;

                    else return $result/6*100;
                }
            }
            return 0;
        }

        return 0;
    }
    public function getProbLargeStraigth($dices){
        $no_repeated_dices = $this->imports->takeOfRepeatedNumbers($dices); //it's already sorted the array
        $length = count($no_repeated_dices);
        if($length > 1){
            $cleaned_array = $this->imports->takeOfBigDifferenceNumbers($no_repeated_dices, 5);
            $new_length = count($cleaned_array);
            if($new_length > 1){
                $difference = 5-$new_length;
                if($difference <= 0) //Have sequence (it's impossible to be less than 0)
                    return 100;
                else{
                    $result = $this->imports->fatorial($difference);
                    if($difference == 3)
                        return $result/216*100;
                    if($difference == 2)
                        return $result/36*100;
                    else{
                        if($cleaned_array[0] == 2)
                            return (2*$result)/6*100;
                        else return $result/6*100;
                    }
                }
            }
            return 0;
        }

        return 0;
    }
}