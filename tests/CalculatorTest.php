<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Services\PromotionCalculator;

class CalculatorTest extends TestCase
{

//    COVERAGE TESTS
// xdebug needed for coverage tests
//  ./bin/phpunit --coverage-text




//    public function testSomething()
//    {
//        $calculator = new Calculator();
//        $result = $calculator->add(1,9);
//        $this->assertEquals(10, $result);
//    }

    public function testSomething()
    {
//        Mocked means we wont gonna use file for calculation
        $calculator = $this->getMockBuilder(PromotionCalculator::class)
            ->setMethods(['getPromotionPrecentage'])
            ->getMock();

        $calculator->expects($this->any())
            ->willReturn(20);

        $result = $calculator->calculatePriceAfterPromotion(1,9);
        // 10 - 20%*10{2} = 8

        $this->assertEquals(8, $result);

        $result = $calculator->calculatePriceAfterPromotion(10, 20, 50);

        // 80 - 20%*80{16} = 64

        $this->assertEquals(64, $result);

    }
}
