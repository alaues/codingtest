<?php

namespace App\Contracts;

use App\Models\PurchasedItem;

/**
 * Interface PurchasedItemInterface
 * @package App\Machine
 */
interface PurchasedItemInterface
{
    /**
     * @param int $itemQuantity
     * @return $this
     */
    public function setItemQuantity(int $itemQuantity): self;

    /**
     * @param float $paidAmount
     * @return $this
     */
    public function setTotalAmount(float $paidAmount): self;
    /**
     * @param float $changeAmount
     * @return void
     */
    public function setChangeAmount(float $changeAmount): self;

    /**
     * @return integer
     */
    public function getItemQuantity(): int;

    /**
     * @return float
     */
    public function getTotalAmount(): float;

    /**
     * @return bool
     */
    public function hasChange(): bool;

    /**
     * Returns the change in this format:
     *
     * Coin Count
     * 0.01 0
     * 0.02 0
     * .... .....
     *
     * @return array
     */
    public function getChange(): array;
}