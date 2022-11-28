<?php

namespace CodePilots\SymfonyCommandIo\tests\Command;

use CodePilots\SymfonyCommandIo\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:example')]
class ExampleCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = $this->createStyle($input, $output);

        // Your code

        $io->writelnPrefix('<info>done!</info>');

        return $this->success();
    }
}
