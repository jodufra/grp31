
<?php
    /**
     * Created by PhpStorm.
     * User: andre
     * Date: 05-01-2015
     * Time: 18:53
     */
class PossibleMoves {

    public $ones = true;
    public $twos = true;
    public $threes = true;
    public $fours = true;
    public $fives = true;
    public $sixes = true;
    public $threeOfKind = true;
    public $fourOfKind = true;
    public $fullHouse = true;
    public $smallStraigth = true;
    public $largeStraigth = true;
    public $chance = true;

}

class Bot{

    private $first_roll_dices = [];
    private $first_saved_dices = [];
    private $second_roll_dices = [];
    private $second_saved_dices = [];
    private $final_dices = [];

    /*
*   ???_roll_dices -> contains all the dices (it concats the last saved dices with the new results of that roll)
*   ???_saved_dices -> contains only the dices saved in that round (before playing the next one).
*/
    public function getWebProtocol(){
        return
            array(
                'first_dices' => $this->first_roll_dices,
                's_first_dices' => $this->first_saved_dices,
                'second_dices' => $this->second_roll_dices,
                's_second_dices' => $this->second_saved_dices,
                'final_dices' => $this->final_dices);
    }

}

class Moves {

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
    //----FUNCTIONS-----

    public function getOnes($dices){
        return getHowManyMatches($dices, 1);
    }
    public function getTwos($dices){
        return getHowManyMatches($dices, 2);
    }
    public function getThrees($dices){
        return getHowManyMatches($dices, 3);
    }
    public function getFours($dices){
        return getHowManyMatches($dices, 4);
    }
    public function getFives($dices) {
        return getHowManyMatches($dices, 5);
    }
    public function getSixes($dices) {
        return getHowManyMatches($dices, 6);
    }
    public function getProbThreeOfKind($dices) {
        $matches = [];
        $value = 0;
        for($i = 0; $i<count($dices); $i++){
            $value=$dices[$i];
            if($value > 3)
                $matches = array_merge($matches,getHowManyMatches($dices, $value));
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
                $matches = array_merge($matches, getHowManyMatches($dices, $value));
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
                $matches = array_merge($matches, getHowManyMatches($dices, $value));
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
        $r_dices = getRepeatedDices($dices);
        $length = count($r_dices);

        if($length >= 2) {
            if($r_dices[0] !== $r_dices[$length-1]){
                $r_dices_splitted = splitArray($r_dices, $r_dices[$length-1]);
                if((count($r_dices_splitted.first) ==  2 && count($r_dices_splitted.second) == 3)||(count($r_dices_splitted.first) ==  3 && count($r_dices_splitted.second) == 2)) //already have a full house
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
        $no_repeated_dices = takeOfRepeatedNumbers($dices); //it's already sorted the array
        $length = count($no_repeated_dices);
        if($length > 1){
            $cleaned_array = takeOfBigDifferenceNumbers($no_repeated_dices, 4);
            $new_length = count($cleaned_array);
            if($new_length > 1){
                $difference = 4-$new_length;
                if($difference <= 0) //Have sequence
                    return 100;
                else{
                    $result = fatorial($difference);
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
        $no_repeated_dices = takeOfRepeatedNumbers($dices); //it's already sorted the array
        $length = count($no_repeated_dices);
        if($length > 1){
            $cleaned_array = takeOfBigDifferenceNumbers($no_repeated_dices, 5);
            $new_length = count($cleaned_array);
            if($new_length > 1){
                $difference = 5-$new_length;
                if($difference <= 0) //Have sequence (it's impossible to be less than 0)
                    return 100;
                else{
                    $result = fatorial($difference);
                    if($difference == 3)
                        return $result/216*100;
                    if($difference == 2)
                        return result/36*100;
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


function getSequenceDices($dices, $max){
    sort($dices);
    $dices = takeOfRepeatedNumbers($dices);
    return takeOfBigDifferenceNumbers($dices, $max);
}

function takeOffNumberFromSequence($dices){
    $new_array = [];
    $i = 0;
    $k = 5;
    if($dices[1] - $dices[0] > $dices[count($dices)-1] - $dices[count($dices)-2])
        $i = 1;
    else $k = 4;

    for(; $i < $k; $i++){
        array_push($new_array, $dices[$i]);
    }
    return $new_array;
}

function takeOfDicesFromArray($array1, $array2){
    $new_array = [];
    $add = true;
    for($i = 0; $i<count($array1); $i++){
        for($j = 0; j<count($array2); $j++){
            if($array1[$i] == $array2[$j]){
                $add = false;
                break;
            }
        }
        if($add)
            array_push($new_array, $array1[$i]);
        else $add = true;
    }
    return $new_array;
}

/*---------CLASSES-----------------------------*/
function fatorial($n){
    $result = 1;
    if($n <= 0)
        return 1;
    while($n >= 1){
        $result = $result * $n;
        $n = $n - 1;
    }
    return $result;
}

function takeOfBigDifferenceNumbers($array, $max){
    $length = count($array);
    $j = -1;
    if($length >= 2){
        for($i = 0; $i<$length-1; $i++){
            if($array[$i+1]-$array[0]>=$max){
                $j = $i + 1;
                break;
            }
        }
        if($j !== -1){
            $new_array = [];
            for($i = 0; $i < $j; $i++){
                array_push($new_array, $array[$i]);
            }
            return $new_array;
        }
    }
    return $array;
}

function takeOfRepeatedNumbers($array){
    $new_array = [];
    sort($array); // sort array

    array_push($new_array, $array[0]);
    for($i = 1; $i < count($array); $i++){
        if($new_array[count($new_array) - 1] != $array[i])
            array_push($new_array, $array[$i]);
    }
    return $new_array;
}

function getRepeatedDices($dices){
    $new_array = [];
    $add_more = true;
    sort($dices);


    for($i = 0; $i<count($dices)-1 ; $i++){
        if($dices[$i+1] == $dices[$i]){
            array_push($new_array, $dices[$i]);
            if($add_more == true){
                array_push($new_array, $dices[$i]);
                $add_more = false;
            }
        }
        else $add_more = true;
    }
    return $new_array;
}

function getHowManyMatches($array, $needle){
    $count = 0;
    for($i = 0; $i <  count($array); $i++){
        if($array[$i] == $needle)
            $count += 1;
    }
    return $count;
}

function splitArray($array, $number){
    $array1 = [];
    $array2 = [];

    for($i = 0; $i < count($array); $i++){ //Fill first array
        if($array[$i] != $number){
            array_push($array1,$array[$i]);
        }
        else break;
    }

    for(; $i < count($array); $i++){ //Fill second array
        array_push($array2, $array[$i]);
    }

    return array(
        'first' => array1,
        'second' => array2
    );
}




$DICES = 5;

function getRandomDice(){
    return rand(0, 6);
}
function getDices($n_dices) {
    $array2 = [];
    for($i = 0; $i < $n_dices; $i++){
        array_push($array2, getRandomDice());
    }
    return $array2;
}
function showProbs($dices, $num){
    /*  error_log('\nProbabilities ' . $num);
      error_log('\n-----------\n');
      error_log("Prob Yahtzee: " . moves.getProbYahtzee($dices) . " Prob Full House: " . moves.getProbFullHouse($dices) . " Prob Large Straight: " . moves.getProbLargeStraigth($dices) + " Prob Small straight: " + moves.getProbSmallStraigth($dices) + " Prob 4 of a Kind: " + moves.getProbFourOfKind($dices) + " Prob 3 of a Kind: " + moves.getProbThreeOfKind($dices));
      error_log('\n-----------\n');*/
}

//Must check function getSequenceDices (tem bug no takeOfBigDifference(dices, max)) TESTAR NOVAMENTE!
function play($dices, $num_roll){

    showProbs($dices, $num_roll);
    if($num_roll == 1){
        bot.first_roll_dices = $dices;
    }
    else if($num_roll == 2)
        bot.second_roll_dices = $dices;
    else bot.final.dices = $dices;

    /*-----------YAHTZEE-------------*/
    $prob = moves.getProbYahtzee($dices);
    if($prob > 16){

        error_log('Chegou aqui');
        if($prob == 100){
            return bot.getWebProtocol(); //YATHZEE
        }
        if($num_roll != 3){
            $r_dices = getRepeatedDices($dices),
				$new_dices = array_merge($r_dices, getDices($DICES - count($r_dices))); //Join the two arrays

			if($num_roll == 1)
                bot.first_saved_dices = $r_dices;
            else
                bot.second_saved_dices = $r_dices;

			return play($new_dices, $num_roll+1);
		}
    }
    /*-----------END YAHTZEE-------------*/

    /*-----------LARGE STRAIGTH-------------*/
    if(bot.possibleMoves.largeStraigth){
        $prob = moves.getProbLargeStraigth($dices);
        if($prob > 16){ //means that have already a SMALL STRAIGHT
            if($prob == 100){
                bot.possibleMoves.largeStraigth = false;
                return bot.getWebProtocol();
            }
            if($num_roll != 3){
                $straigth_dices = getSequenceDices($dices, 5);
                $new_dices = [];

                if(count($straigth_dices) == $DICES)
                    $straigth_dices = takeOffNumberFromSequence($straigth_dices); //take off last number

                $new_dices = array_merge($straigth_dices,getDices($DICES - straigth_dices.length)); //Join the two arrays

                if($num_roll == 1)
                    bot.first_saved_dices = $straigth_dices;
                else
                    bot.second_saved_dices = $straigth_dices;

                return play($new_dices, $num_roll+1);
            }
        }
    }
    /*-----------END LARGE STRAIGTH-------------*/

    /*-----------FULL HOUSE-------------*/
    if(bot.possibleMoves.fullHouse){
        $prob = moves.getProbFullHouse($dices);
        if($prob > 13){
            if($prob == 100){
                bot.possibleMoves.fullHouse = false;
                return bot.getWebProtocol();
            }
            if($num_roll != 3){
                $r_dices = getRepeatedDices($dices);
                $new_dices = array_merge($r_dices,getDices($DICES - count($r_dices)));

                if($num_roll == 1)
                    bot.first_saved_dices = $r_dices;
                else
                    bot.second_saved_dices = $r_dices;

                return play($new_dices, $num_roll+1);
            }
        }
    }
    /*-----------END FULL HOUSE-------------*/

    /*-----------SMALL STRAIGTH-------------*/
    if(bot.possibleMoves.smallStraigth){ //it only arrives here if the largeStraight had been already played, if num_roll==3 and largeStraight prob != 100.
        $prob = moves.getProbSmallStraigth($dices);
        if($prob > 16){
            if($prob == 100){
                bot.possibleMoves.smallStraigth = false;
                return bot.getWebProtocol();
            }
            if($num_roll != 3){
                $straigth_dices = getSequenceDices($dices, 4);
                $new_dices = [];

                if(count($straigth_dices) == $DICES)
                    $straigth_dices = takeOffNumberFromSequence($straigth_dices); //take off last number

                $new_dices = array_merge($straigth_dices,getDices($DICES - count($straigth_dices))); //Join the two arrays

                if($num_roll == 1)
                    bot.first_saved_dices = $straigth_dices;
                else
                    bot.second_saved_dices = $straigth_dices;

                return play($new_dices, $num_roll+1);
            }
        }
    }
    /*-----------END SMALL STRAIGTH-------------*/

    /*-----------FOUR OF A KIND-------------*/
    if(bot.possibleMoves.fourOfKind){
        $prob = moves.getProbFourOfKind($dices);
        if($prob > 16){
            if($prob == 100){
                bot.possibleMoves.fourOfKind = false;
                return bot.getWebProtocol();
            }
            if($num_roll != 3){
                $r_dices = getRepeatedDices($dices);
                $new_dices = [];

                if($r_dices[0] != $r_dices[count($r_dices)-1]){
                    $a = splitArray($r_dices, $r_dices[length-1]);
                    $r_dices = (count($a.first) > count($a.second) ? $a.first : $a.second);
                }
                $new_dices = array_merge($r_dices,getDices($DICES - count($r_dices)));

                if($num_roll == 1)
                    bot.first_saved_dices = $r_dices;
                else
                    bot.second_saved_dices = $r_dices;

                return play($new_dices, $num_roll+1);
            }
        }
    }
    /*-----------END FOUR OF A KIND-------------*/

    /*-----------THREE OF A KIND-------------*/
    if(bot.possibleMoves.threeOfKind){
        $prob = moves.getProbThreeOfKind($dices);
        if($prob > 16){
            if($prob == 100){
                bot.possibleMoves.threeOfKind = false;
                return bot.getWebProtocol();
            }
            if($num_roll != 3){
                $r_dices = getRepeatedDices($dices);
                $new_dices = array_merge($r_dices,getDices($DICES - count($r_dices)));

                if($num_roll == 1)
                    bot.first_saved_dices = $r_dices;
                else
                    bot.second_saved_dices = $r_dices;

                return play($new_dices, $num_roll+1);
            }
        }
    }

    return bot.getWebProtocol();
    /*-----------END THREE OF A KIND-------------*/
}

