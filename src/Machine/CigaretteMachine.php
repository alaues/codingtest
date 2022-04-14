<?php

namespace App\Machine;

use App\Contracts\MachineInterface;
use App\Contracts\PurchasedItemInterface;
use App\Contracts\PurchaseTransactionInterface;
use App\Exceptions\InsufficientAmountException;

/**
 * Class CigaretteMachine
 * @package App\Machine
 */
class CigaretteMachine implements MachineInterface
{

    private const ITEM_PRICE = 4.99;

    /**
     * @var PurchasedItemInterface
     */
    private PurchasedItemInterface $purchasedItem;

    public function __construct(PurchasedItemInterface $purchasedItem)
    {
        $this->purchasedItem = $purchasedItem;
    }

    /**
     * @return float
     */
    public function getItemPrice(): float
    {
        return round(self::ITEM_PRICE, 2);
    }

    /**
     * Execution of purchase
     *
     * @throws InsufficientAmountException
     */
    public function execute(PurchaseTransactionInterface $purchaseTransaction): PurchasedItemInterface
    {
        $change = round($purchaseTransaction->getPaidAmount() - $purchaseTransaction->getItemQuantity() * $this->getItemPrice(), 2);
        if ($change < 0) {
            throw new InsufficientAmountException();
        }

        return $this->purchasedItem
            ->setItemQuantity($purchaseTransaction->getItemQuantity())
            ->setTotalAmount($purchaseTransaction->getPaidAmount())
            ->setChangeAmount($change);
    }
}