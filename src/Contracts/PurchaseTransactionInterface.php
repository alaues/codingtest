<?php

namespace App\Contracts;

use App\Models\PurchaseTransaction;

/**
 * Interface PurchasableItemInterface
 * @package App\Machine
 */
interface PurchaseTransactionInterface
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
    public function setPaidAmount(float $paidAmount): self;

    /**
     * @return integer
     */
    public function getItemQuantity(): int;

    /**
     * @return float
     */
    public function getPaidAmount(): float;
}