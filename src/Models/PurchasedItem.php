<?php

namespace App\Models;

use App\Contracts\PurchasedItemInterface;

class PurchasedItem implements PurchasedItemInterface
{
    /**
     * @var int
     */
    private int $itemQuantity;

    /**
     * @var float
     */
    private float $paidAmount;

    /**
     * @var float
     */
    private float $changeAmount;

    /**
     * @param int $itemQuantity
     * @return $this
     */
    public function setItemQuantity(int $itemQuantity): self
    {
        $this->itemQuantity = $itemQuantity;
        return $this;
    }

    /**
     * @param float $paidAmount
     * @return $this
     */
    public function setTotalAmount(float $paidAmount): self
    {
        $this->paidAmount = $paidAmount;
        return $this;
    }

    /**
     * @param float $changeAmount
     * @return void
     */
    public function setChangeAmount(float $changeAmount): self
    {
        $this->changeAmount = $changeAmount;
        return $this;
    }

    /**
     * @return int
     */
    public function getItemQuantity(): int
    {
        return $this->itemQuantity;
    }

    /**
     * @return float
     */
    public function getTotalAmount(): float
    {
        return $this->paidAmount;
    }

    /**
     * @return array
     */
    public function getChange(): array
    {
        $result = [];
        $remainToPay = $this->changeAmount;
        while ($remainToPay) {
            if ($value = EuroCoin::findBestCoinValue($remainToPay)) {
                $remainToPay = round($remainToPay - $value, 2);
                $result[] = (string) $value;
            }
        }
        if (empty($result)) {
            return [];
        }
        $counts = array_count_values($result);
        array_walk($counts, static function (&$count, $name) {
            $count = [$name, $count];
        });
        return $counts;
    }

    /**
     * @return bool
     */
    public function hasChange(): bool
    {
        return $this->changeAmount > 0;
    }
}