<?php

class YahtzeeCombinationCalculatorTest extends TestCase {

	public function test()
	{
        $testA=array(1,2,3,4,5);
        $resultA =  [
            'one' => 1,
            'two' => 2,
            'three' => 3,
            'four' => 4,
            'five' => 5,
            'six' => 0,
            'sum' => 15,
            'bonus' => 0,
            'threeOfaKind' => 0,
            'fourOfaKind' => 0,
            'fullHouse' => 0,
            'smallStraight' => 30,
            'largeStraight' => 40,
            'chance' => 15,
            'yahtzee' => 0
        ];
        $testB=array(1,1,1,6,6);
        $resultB =  [
            'one' => 3,
            'two' => 0,
            'three' => 0,
            'four' => 0,
            'five' => 0,
            'six' => 12,
            'sum' => 15,
            'bonus' => 0,
            'threeOfaKind' => 15,
            'fourOfaKind' => 0,
            'fullHouse' => 25,
            'smallStraight' => 0,
            'largeStraight' => 0,
            'chance' => 15,
            'yahtzee' => 0
        ];
        $testC=array(1,1,1,1,1);
        $resultC =  [
            'one' => 5,
            'two' => 0,
            'three' => 0,
            'four' => 0,
            'five' => 0,
            'six' => 0,
            'sum' => 5,
            'bonus' => 0,
            'threeOfaKind' => 5,
            'fourOfaKind' => 5,
            'fullHouse' => 0,
            'smallStraight' => 0,
            'largeStraight' => 0,
            'chance' => 5,
            'yahtzee' => 50
        ];
        $calculator = new YahtzeeCombinationCalculator();

        $result=$calculator->getScore($testA);
        $this->assertEquals($result, $resultA);

        $result=$calculator->getScore($testB);
        $this->assertEquals($result, $resultB);

        $result=$calculator->getScore($testC);
        $this->assertEquals($result, $resultC);



	}

}