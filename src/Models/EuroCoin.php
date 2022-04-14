<?php

namespace App\Models;

class EuroCoin
{

    private const ONE_CENT      = 1;
    private const TWO_CENTS     = 2;
    private const FIVE_CENTS    = 5;
    private const TEN_CENTS     = 10;
    private const TWENTY_CENTS  = 20;
    private const FIFTY_CENTS   = 50;
    private const ONE_EURO      = 100;//in cents
    private const TWO_EUROS     = 200;//in cents

    /**
     * @param float $amount
     * @return float
     */
    public static function findBestCoinValue(float $amount): float
    {
        $amount *= 100;
        if ($amount % self::TWO_EUROS === 0) {
            $value = self::TWO_EUROS;
        } elseif ($amount % self::ONE_EURO === 0) {
            $value = self::ONE_EURO;
        } elseif ($amount % self::FIFTY_CENTS === 0) {
            $value = self::FIFTY_CENTS;
        } elseif ($amount % self::TWENTY_CENTS === 0) {
            $value = self::TWENTY_CENTS;
        } elseif ($amount % self::TEN_CENTS === 0) {
            $value = self::TEN_CENTS;
        } elseif ($amount % self::FIVE_CENTS === 0) {
            $value = self::FIVE_CENTS;
        } elseif ($amount % self::TWO_CENTS === 0) {
            $value = self::TWO_CENTS;
        } elseif ($amount % self::ONE_CENT === 0) {
            $value = self::ONE_CENT;
        }

        return $value / 100 ?? 0.00;
    }
}