<?php
/**
 * Created by PhpStorm.
 * User: Schmeisk
 * Date: 30/10/2014
 * Time: 19:02
 */

class YahtzeeCombinationCalculator
{
    public function __construct()
    {
    }
    public function getOnesScore($dices)
    {
        $total=$dices[1];

        return $total;
    }
    public function getTwosScore($dices)
    {
        $total=$dices[2]*2;

        return $total;
    }
    public function getThreesScore($dices)
    {
        $total=$dices[3]*3;

        return $total;
    }
    public function getFoursScore($dices)
    {
        $total=$dices[4]*4;

        return $total;
    }
    public function getFivesScore($dices)
    {
        $total=$dices[5]*5;

        return $total;
    }
    public function getSixesScore($dices)
    {
        $total=$dices[6]*6;

        return $total;
    }
    public function getBonusScore($sum)
    {
        if($sum>63){
            return 35;
        }else{
            return 0;
        }
    }
    public function getThreeOfaKindScore($values)
    {
        $sum=0;
        for($i=1;$i<7;$i++) {
            if($values[$i]!=0)
                $sum+=$values[$i]*$i;
        }
        if($values[1]>2){
            return $sum;
        }elseif($values[2]>2){
            return $sum;
        }elseif($values[3]>2){
            return $sum;
        }elseif($values[4]>2){
            return $sum;
        }elseif($values[5]>2){
            return $sum;
        }elseif($values[6]>2){
            return $sum;
        }
        return 0;
    }
    public function getFourOfaKindScore($values)
    {
        $sum=0;
        for($i=1;$i<7;$i++) {
            if($values[$i]!=0)
                $sum+=$values[$i]*$i;
        }
        if($values[1]>3){
            return $sum;
        }elseif($values[2]>3){
            return $sum;
        }elseif($values[3]>3){
            return $sum;
        }elseif($values[4]>3){
            return $sum;
        }elseif($values[5]>3){
            return $sum;
        }elseif($values[6]>3){
            return $sum;
        }
        return 0;
    }
    public function getFullHouseScore($values)
    {
        $vthree = false; $vtwo = false;
        foreach($values as $value) {
            if($value == 3){
                $vthree = true;
            }
            if($value == 2){
                $vtwo = true;
            }
            if($vthree && $vtwo){
                return 25;
            }
        }
        return 0;
    }

	public function getLargeStraightScore($values)
	{
		$dif = 0;
		$som = 0;
		for ($i = 1;$i < 7 && $som < 6; $i++) {
			if ($dif == 0 && $som == 5) {
				return 40;
			}
			if ($values[$i] == 1) {
				$som++;
			}
		}
		return 0;
	}


 public function getSmallStraightScore($values)
{
	$dif = 0;
	$som = 0;
	for ($i = 1; $i < 7 && $som < 5; $i++) {
		if ($dif == 0 && $som == 4) {
			return 30;
		}
		if ($values[$i] == 1) {
			$som++;
		}
	}
	return 0;
}
//    public function getSmallStraightScore($values)
//    {
//
//        if(($values[1]==1 && $values[2]==1 &&  $values[3]==1 &&  $values[4]==1)||( $values[2]==1 &&  $values[3]==1 &&  $values[4]==1 &&  $values[5]==1)||( $values[3]==1 &&  $values[4]==1 &&  $values[5]==1 &&  $values[6]==1)) {
//            return 30;
//        }
//        return 0;
//    }

//    public function getLargeStraightScore($values)
//    {
//        if(($values[1]==1 && $values[2]==1 && $values[3]==1 && $values[4]==1 && $values[5]==1)||($values[2]==1 && $values[3]==1 && $values[4]==1 && $values[5]==1 && $values[6]==1)) {
//            return 40;
//        }
//        return 0;
//    }
    public function getChanceScore($dices)
    {
        $total=0;
        foreach($dices as $dice) {
                $total+=$dice;
        }
        return $total;
    }
    public function getYahtzeeScore($values)
    {
        if($values[1]>4){
            return 50;
        }elseif($values[2]>4){
            return 50;
        }elseif($values[3]>4){
            return 50;
        }elseif($values[4]>4){
            return 50;
        }elseif($values[5]>4){
            return 50;
        }elseif($values[6]>4){
            return 50;
        }
        return 0;
    }
    public function getScore($dices)
    {

        $values = array();
        for($i=0;$i<7;$i++) {
            $values[$i]=0;
        }
        for($i=0;$i<5;$i++) {
            $values[$dices[$i]]++;
        }
        for($i=1;$i<7;$i++) {
            if(!isset($values[$i]))
                $values[$i]=0;
        }

        $oneScore=$this->getOnesScore($values);
        $twoScore=$this->getTwosScore($values);
        $threeScore=$this->getThreesScore($values);
        $fourScore=$this->getFoursScore($values);
        $fiveScore=$this->getFivesScore($values);
        $sixScore=$this->getSixesScore($values);
        $sumScore= $oneScore+$twoScore+$threeScore+$fourScore+$fiveScore+$sixScore;
        $bonusScore=$this->getBonusScore($sumScore);
        $threeOfaKindScore=$this->getThreeOfaKindScore($values);
        $fourOfaKindScore=$this->getFourOfaKindScore($values);
        $fullHouseScore = $this->getFullHouseScore($values);
        $smallStraightScore =$this-> getSmallStraightScore($values);
        $largeStraightScore = $this->getLargeStraightScore($values);
        $chanceScore=$this->getChanceScore($dices);
        $yahtzeeScore=$this->getYahtzeeScore($values);
        $result =  [
            'one' => $oneScore,
            'two' => $twoScore,
            'three' => $threeScore,
            'four' => $fourScore,
            'five' => $fiveScore,
            'six' => $sixScore,
            'sum' => $sumScore,
            'bonus' => $bonusScore,
            'threeOfaKind' => $threeOfaKindScore,
            'fourOfaKind' => $fourOfaKindScore,
            'fullHouse' => $fullHouseScore,
            'smallStraight' => $smallStraightScore,
            'largeStraight' => $largeStraightScore,
            'chance' => $chanceScore,
            'yahtzee' => $yahtzeeScore
        ];
        return $result;
    }

}
