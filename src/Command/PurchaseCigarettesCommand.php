<?php

namespace App\Command;

use App\Contracts\PurchaseCigarettesServiceInterface;
use App\Providers\ServiceLocator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CigaretteMachine
 * @package App\Command
 */
class PurchaseCigarettesCommand extends Command
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('packs', InputArgument::REQUIRED, "How many packs do you want to buy?");
        $this->addArgument('amount', InputArgument::REQUIRED, "The amount in euro.");
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return void
     * @throws \App\Exceptions\UndefinedServiceException
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $service = ServiceLocator::get(PurchaseCigarettesServiceInterface::class);
        $service->execute($input, $output);
    }
}