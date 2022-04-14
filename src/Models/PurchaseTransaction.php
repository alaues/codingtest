<?php

namespace App\Models;

use App\Contracts\PurchaseTransactionInterface;

class PurchaseTransaction implements PurchaseTransactionInterface
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
    public function setPaidAmount(float $paidAmount): self
    {
        $this->paidAmount = $paidAmount;
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
    public function getPaidAmount(): float
    {
        return $this->paidAmount;
    }
}