<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 05-01-2015
 * Time: 16:49
 */
class Imports
{

    public function getSequenceDices($dices, $max)
    {
        sort($dices);
        $dices = $this->takeOfRepeatedNumbers($dices);
        return $this->takeOfBigDifferenceNumbers($dices, $max);
    }

    public function takeOffNumberFromSequence($dices)
    {
        $new_array = [];
        $i = 0;
        $k = 5;
        if ($dices[1] - $dices[0] > $dices[count($dices) - 1] - $dices[count($dices) - 2])
            $i = 1;
        else $k = 4;

        for (; $i < $k; $i++) {
            array_push($new_array, $dices[$i]);
        }
        return $new_array;
    }

    public function takeOfDicesFromArray($array1, $array2)
    {
        $new_array = [];
        $add = true;
        for ($i = 0; $i < count($array1); $i++) {
            for ($j = 0; $j < count($array2); $j++) {
                if ($array1[$i] == $array2[$j]) {
                    $add = false;
                    break;
                }
            }
            if ($add)
                array_push($new_array, $array1[$i]);
            else $add = true;
        }
        return $new_array;
    }

    /*---------CLASSES-----------------------------*/
    public function fatorial($n)
    {
        $result = 1;
        if ($n <= 0)
            return 1;
        while ($n >= 1) {
            $result = $result * $n;
            $n = $n - 1;
        }
        return $result;
    }

    public function takeOfBigDifferenceNumbers($array, $max)
    {
        $length = count($array);
        $j = -1;
        if ($length >= 2) {
            for ($i = 0; $i < $length - 1; $i++) {
                if ($array[$i + 1] - $array[0] >= $max) {
                    $j = $i + 1;
                    break;
                }
            }
            if ($j !== -1) {
                $new_array = [];
                for ($i = 0; $i < $j; $i++) {
                    array_push($new_array, $array[$i]);
                }
                return $new_array;
            }
        }
        return $array;
    }

    public function takeOfRepeatedNumbers($array)
    {
        $new_array = [];
        sort($array); // sort array

        array_push($new_array, $array[0]);
        for ($i = 1; $i < count($array); $i++) {
            if ($new_array[count($new_array) - 1] != $array[$i])
                array_push($new_array, $array[$i]);
        }
        return $new_array;
    }

    public function getRepeatedDices($dices)
    {
        $new_array = [];
        $add_more = true;
        sort($dices);


        for ($i = 0; $i < count($dices) - 1; $i++) {
            if ($dices[$i + 1] == $dices[$i]) {
                array_push($new_array, $dices[$i]);
                if ($add_more == true) {
                    array_push($new_array, $dices[$i]);
                    $add_more = false;
                }
            } else $add_more = true;
        }
        return $new_array;
    }

    public function getHowManyMatches($array, $needle)
    {
        $count = 0;
        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i] == $needle)
                $count += 1;
        }
        return $count;
    }

    public function splitArray($array, $number)
    {
        $array1 = [];
        $array2 = [];

        for ($i = 0; $i < count($array); $i++) { //Fill first array
            if ($array[$i] != $number) {
                array_push($array1, $array[$i]);
            } else break;
        }

        for (; $i < count($array); $i++) { //Fill second array
            array_push($array2, $array[$i]);
        }

        return array(
            'first' => $array1,
            'second' => $array2
        );
    }
}
