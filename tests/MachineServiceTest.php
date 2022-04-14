<?php

use App\Contracts\MachineInterface;
use App\Contracts\PurchaseTransactionInterface;
use App\Exceptions\UndefinedServiceException;
use App\Providers\ServiceLocator;
use App\Providers\ServiceProvider;
use PHPUnit\Framework\TestCase;

class MachineServiceTest extends TestCase
{
    private PurchaseTransactionInterface $transaction;
    private MachineInterface $machineService;

    private const PURCHASE_OPTIONS = [
        ['amount' => 5,     'itemCount' => 1],
        ['amount' => 5,     'itemCount' => 2],
        ['amount' => 9.95,  'itemCount' => 2],
        ['amount' => 10,    'itemCount' => 2],
    ];

    /**
     * @throws UndefinedServiceException
     */
    public function setUp(): void
    {
        ServiceProvider::boot();
        parent::setUp();

        $this->transaction = ServiceLocator::get(PurchaseTransactionInterface::class);
        $this->machineService = ServiceLocator::get(MachineInterface::class);
    }

    /**
     * Test few purchases with different combination of amount and packs
     * @return void
     */
    public function testMachineService(): void
    {
        foreach (self::PURCHASE_OPTIONS as $option) {
            $this->transaction
                ->setPaidAmount($option['amount'])
                ->setItemQuantity($option['itemCount']);

            $change = $option['amount'] - $this->machineService->getItemPrice() * $option['itemCount'];
            if ($change < 0) {
                $this->expectException(\App\Exceptions\InsufficientAmountException::class);
            }

            $purchaseResult = $this->machineService->execute($this->transaction);
            if ($change > 0) {
                self::assertNotEmpty($purchaseResult->getChange());
                self::assertIsArray($purchaseResult->getChange());
            }
        }
    }

}