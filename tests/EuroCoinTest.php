<?php

class EuroCoinTest extends \PHPUnit\Framework\TestCase
{
    private const COIN_OPTIONS = [
        ['amount' => 0.3,  'change' => 0.1],
        ['amount' => 0.2,  'change' => 0.2],
        ['amount' => 0.4,  'change' => 0.2],
        ['amount' => 3.25,  'change' => 0.05],
        ['amount' => 3.2,  'change' => 0.2],
        ['amount' => 3,  'change' => 1],
        ['amount' => 2,  'change' => 2],
    ];

    /**
     * Test which next coin should be returned as a change to desired amount
     *
     * @return void
     */
    public function testNextCoinToGiveChange(): void
    {
        foreach (self::COIN_OPTIONS as $option) {
            self::assertEquals($option['change'], \App\Models\EuroCoin::findBestCoinValue($option['amount']));
        }
    }
}