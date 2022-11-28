<?php

declare(strict_types=1);

namespace CodePilots\SymfonyCommandIo;

use Symfony\Component\Console\Command\Command as AbstractCommand;
use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method string getName()
 */
abstract class Command extends AbstractCommand
{
    private Microtime $startTime;
    private int $processId;
    private CommandStyle $io;

    public function getProcessId(): int
    {
        return $this->processId;
    }

    public function createStyle(InputInterface $input, OutputInterface $output): CommandStyle
    {
        $io = new CommandStyle($input, $output);
        $io->setPrefix(sprintf('[%s]', $this->getProcessId()));

        return $io;
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->startTime = Microtime::start();
        $this->processId = getmypid() ?: 0;
        $this->io = $this->createStyle($input, $output);
        $this->io->writelnPrefix(sprintf(
            'Command <comment>%s</comment> starting',
            $this->getName(),
        ));
    }

    protected function getExecutionTime(): string
    {
        return $this->startTime->finishTimeFormat();
    }

    protected function success(): int
    {
        $this->io->writelnPrefix(sprintf(
            'Command <comment>complete</comment>, exec time: %s, memory: %s',
            $this->getExecutionTime(),
            (string)Helper::formatMemory(memory_get_usage(true))
        ));

        return self::SUCCESS;
    }

    protected function alreadyRunning(): int
    {
        $this->io->writelnPrefix('The command is already running in another process.');

        return self::SUCCESS;
    }

    protected function failure(string $message = null): int
    {
        if (null !== $message) {
            $this->io->error($message);
        }

        $this->io->writelnPrefix(sprintf(
            'Command <comment>failed</comment>, exec time: %s, memory: %s',
            $this->getExecutionTime(),
            (string)Helper::formatMemory(memory_get_usage(true))
        ));

        return self::FAILURE;
    }
}
