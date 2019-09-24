<?php


namespace App\Services;


class PromotionCalculator
{
    public function calculatePriceAfterPromotion(... $prices) // ... means we can provide as many arguments as we want
    {
        $start = 0;
        foreach ($prices as $price) {
            $start += $price;
        }
        return $start - ($start * $this->getPromotionPrecetage() / 100);
    }

    public function getPromotionPrecetage()
    {
        return (int) \file_get_contents('file.txt');
    }
}