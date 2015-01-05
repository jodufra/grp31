<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 05-01-2015
 * Time: 16:19
 */

require_once('./Bot.php');
require_once('./MovesProbabilities.php');
require_once('./Imports.php');

class BotLogic
{

    public $DICES;
    public $bot;
    public $moves;
    public $imports;

    public function __construct(){
        $this->DICES = 5;
        $this->bot = new Bot();
        $this->moves = new MovesProbabilities();
        $this->imports = new Imports();
    }

    function getRandomDice()
    {
        return rand(0, 6);
    }

    function getDices($n_dices)
    {
        $array2 = [];
        for ($i = 0; $i < $n_dices; $i++) {
            array_push($array2, $this->getRandomDice());
        }
        return $array2;
    }

    function showProbs($dices, $num)
    {
        /*  error_log('\nProbabilities ' . $num);
          error_log('\n-----------\n');
          error_log("Prob Yahtzee: " . moves.getProbYahtzee($dices) . " Prob Full House: " . moves.getProbFullHouse($dices) . " Prob Large Straight: " . moves.getProbLargeStraigth($dices) + " Prob Small straight: " + moves.getProbSmallStraigth($dices) + " Prob 4 of a Kind: " + moves.getProbFourOfKind($dices) + " Prob 3 of a Kind: " + moves.getProbThreeOfKind($dices));
          error_log('\n-----------\n');*/
    }

    //Must check function getSequenceDices (tem bug no takeOfBigDifference(dices, max)) TESTAR NOVAMENTE!
    function play($dices, $num_roll)
    {

        $this->showProbs($dices, $num_roll);
        if ($num_roll == 1) {
            $this->bot->first_roll_dices = $dices;
        } else if ($num_roll == 2)
            $this->bot->second_roll_dices = $dices;
        else $this->bot->final_dices = $dices;

        /*-----------YAHTZEE-------------*/
        $prob = $this->moves->getProbYahtzee($dices);
        if ($prob > 16) {

            if ($prob == 100) {
                return $this->bot->getWebProtocol(); //YATHZEE
            }
            if ($num_roll != 3) {
                $r_dices = $this->imports->getRepeatedDices($dices);
                $new_dices = array_merge($r_dices, $this->getDices($this->DICES - count($r_dices))); //Join the two arrays

                if ($num_roll == 1)
                    $this->bot->first_saved_dices = $r_dices;
                else
                    $this->bot->second_saved_dices = $r_dices;

                return $this->play($new_dices, $num_roll + 1);
            }
        }
        /*-----------END YAHTZEE-------------*/

        /*-----------LARGE STRAIGTH-------------*/
        if ($this->bot->possibleMoves->largeStraigth) {
            $prob = $this->moves->getProbLargeStraigth($dices);
            if ($prob > 16) { //means that have already a SMALL STRAIGHT
                if ($prob == 100) {
                    $this->bot->possibleMoves->largeStraigth = false;
                    return $this->bot->getWebProtocol();
                }
                if ($num_roll != 3) {
                    $straigth_dices = $this->imports->getSequenceDices($dices, 5);
                    $new_dices = [];

                    if (count($straigth_dices) == $this->DICES)
                        $straigth_dices = $this->imports->takeOffNumberFromSequence($straigth_dices); //take off last number

                    $new_dices = array_merge($straigth_dices, $this->getDices($this->DICES - count($straigth_dices))); //Join the two arrays

                    if ($num_roll == 1)
                        $this->bot->first_saved_dices = $straigth_dices;
                    else
                        $this->bot->second_saved_dices = $straigth_dices;

                    return $this->play($new_dices, $num_roll + 1);
                }
            }
        }
        /*-----------END LARGE STRAIGTH-------------*/

        /*-----------FULL HOUSE-------------*/
        if ($this->bot->possibleMoves->fullHouse) {
            $prob = $this->moves->getProbFullHouse($dices);
            if ($prob > 13) {
                if ($prob == 100) {
                    $this->bot->possibleMoves->fullHouse = false;
                    return $this->bot->getWebProtocol();
                }
                if ($num_roll != 3) {
                    $r_dices = $this->imports->getRepeatedDices($dices);
                    $new_dices = array_merge($r_dices, $this->getDices($this->DICES - count($r_dices)));

                    if ($num_roll == 1)
                        $this->bot->first_saved_dices = $r_dices;
                    else
                        $this->bot->second_saved_dices = $r_dices;

                    return $this->play($new_dices, $num_roll + 1);
                }
            }
        }
        /*-----------END FULL HOUSE-------------*/

        /*-----------SMALL STRAIGTH-------------*/
        if ($this->bot->possibleMoves->smallStraigth) { //it only arrives here if the largeStraight had been already played, if num_roll==3 and largeStraight prob != 100.
            $prob = $this->moves->getProbSmallStraigth($dices);
            if ($prob > 16) {
                if ($prob == 100) {
                    $this->bot->possibleMoves->smallStraigth = false;
                    return $this->bot->getWebProtocol();
                }
                if ($num_roll != 3) {
                    $straigth_dices = $this->imports->getSequenceDices($dices, 4);
                    $new_dices = [];

                    if (count($straigth_dices) == $this->$DICES)
                        $straigth_dices = $this->imports->takeOffNumberFromSequence($straigth_dices); //take off last number

                    $new_dices = array_merge($straigth_dices, $this->getDices($this->DICES - count($straigth_dices))); //Join the two arrays

                    if ($num_roll == 1)
                        $this->bot->first_saved_dices = $straigth_dices;
                    else
                        $this->bot->second_saved_dices = $straigth_dices;

                    return $this->play($new_dices, $num_roll + 1);
                }
            }
        }
        /*-----------END SMALL STRAIGTH-------------*/

        /*-----------FOUR OF A KIND-------------*/
        if ($this->bot->possibleMoves->fourOfKind) {
            $prob = $this->moves->getProbFourOfKind($dices);
            if ($prob > 16) {
                if ($prob == 100) {
                    $this->bot->possibleMoves->fourOfKind = false;
                    return $this->bot->getWebProtocol();
                }
                if ($num_roll != 3) {
                    $r_dices = $this->imports->getRepeatedDices($dices);
                    $new_dices = [];

                    if ($r_dices[0] != $r_dices[count($r_dices) - 1]) {
                        $a = $this->imports->splitArray($r_dices, $r_dices[count($r_dices) - 1]);
                        $r_dices = (count($a['first']) > count($a['second']) ? $a['first'] : $a['second']);
                    }
                    $new_dices = array_merge($r_dices, $this->getDices($this->DICES - count($r_dices)));

                    if ($num_roll == 1)
                        $this->bot->first_saved_dices = $r_dices;
                    else
                        $this->bot->second_saved_dices = $r_dices;

                    return $this->play($new_dices, $num_roll + 1);
                }
            }
        }
        /*-----------END FOUR OF A KIND-------------*/

        /*-----------THREE OF A KIND-------------*/
        if ($this->bot->possibleMoves->threeOfKind) {
            $prob = $this->moves->getProbThreeOfKind($dices);
            if ($prob > 16) {
                if ($prob == 100) {
                    $this->bot->possibleMoves->threeOfKind = false;
                    return $this->bot->getWebProtocol();
                }
                if ($num_roll != 3) {
                    $r_dices = $this->imports->getRepeatedDices($dices);
                    $new_dices = array_merge($r_dices, $this->getDices($this->DICES - count($r_dices)));

                    if ($num_roll == 1)
                        $this->bot->first_saved_dices = $r_dices;
                    else
                        $this->bot->second_saved_dices = $r_dices;

                    return $this->play($new_dices, $num_roll + 1);
                }
            }
        }

        return $this->bot->getWebProtocol();
        /*-----------END THREE OF A KIND-------------*/
    }
}