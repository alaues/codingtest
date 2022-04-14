<?php

namespace App\Services;

use App\Contracts\MachineInterface;
use App\Contracts\PurchaseCigarettesServiceInterface;
use App\Contracts\PurchaseTransactionInterface;
use App\Providers\ServiceLocator;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PurchaseCigarettesService implements PurchaseCigarettesServiceInterface
{
    private MachineInterface $machineService;

    /**
     * @param MachineInterface $machineService
     */
    public function __construct(MachineInterface $machineService)
    {
        $this->machineService = $machineService;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    public function execute(InputInterface $input, OutputInterface $output): void
    {
        $itemCount = (int) $input->getArgument('packs');
        $amount = (float) \str_replace(',', '.', $input->getArgument('amount'));

        try {
            /**
             * @var PurchaseTransactionInterface $transaction
             */
            $transaction = ServiceLocator::get(PurchaseTransactionInterface::class);
            $transaction
                ->setPaidAmount($amount)
                ->setItemQuantity($itemCount);

            $purchaseResult = $this->machineService->execute($transaction);

            $output->writeln(sprintf('You bought <info>%d</info> packs of cigarettes for <info>%.2f</info>, each for <info>%.2f</info>. ',
                $purchaseResult->getItemQuantity(),
                $purchaseResult->getTotalAmount(),
                $this->machineService->getItemPrice()
            ));

            if ($purchaseResult->hasChange()) {
                $output->writeln('Your change is:');

                $table = new Table($output);
                $table
                    ->setHeaders(array('Coins', 'Count'))
                    ->setRows($purchaseResult->getChange());
                $table->render();
            }
        } catch (\Exception $exception) {
            $output->writeln($exception->getMessage());
        }
    }
}