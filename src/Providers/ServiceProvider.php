<?php

namespace App\Providers;

use App\Contracts\MachineInterface;
use App\Contracts\PurchaseCigarettesServiceInterface;
use App\Contracts\PurchasedItemInterface;
use App\Contracts\PurchaseTransactionInterface;
use App\Exceptions\UndefinedServiceException;
use App\Machine\CigaretteMachine;
use App\Models\PurchasedItem;
use App\Models\PurchaseTransaction;
use App\Services\PurchaseCigarettesService;

class ServiceProvider
{
    /**
     * Boot the services
     *
     * @return void
     * @throws UndefinedServiceException
     */
    public static function boot(): void
    {
        ServiceLocator::add(PurchasedItemInterface::class, new PurchasedItem());
        ServiceLocator::add(PurchaseTransactionInterface::class, new PurchaseTransaction());
        ServiceLocator::add(
            MachineInterface::class,
            new CigaretteMachine(ServiceLocator::get(PurchasedItemInterface::class))
        );
        ServiceLocator::add(
            PurchaseCigarettesServiceInterface::class,
            new PurchaseCigarettesService(ServiceLocator::get(MachineInterface::class))
        );
    }
}