<?php

require_once('./PossibleMoves.php');

class Bot
{

    public $first_roll_dices = [];
    public $first_saved_dices = [];
    public $second_roll_dices = [];
    public $second_saved_dices = [];
    public $final_dices = [];
    public $possibleMoves = [];

    public function __construct() {
        $this->possibleMoves = new PossibleMoves();
    }
    /*
*   ???_roll_dices -> contains all the dices (it concats the last saved dices with the new results of that roll)
*   ???_saved_dices -> contains only the dices saved in that round (before playing the next one).
*/
    public function getWebProtocol()
    {
        return
            array(
                'first_dices' => $this->first_roll_dices,
                's_first_dices' => $this->first_saved_dices,
                'second_dices' => $this->second_roll_dices,
                's_second_dices' => $this->second_saved_dices,
                'final_dices' => $this->final_dices);
    }
}