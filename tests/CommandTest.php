<?php

declare(strict_types=1);

use CodePilots\SymfonyCommandIo\tests\Command\ExampleCommand;
use JetBrains\PhpStorm\NoReturn;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * @internal
 *
 * @coversNothing
 */
final class CommandTest extends TestCase
{
    private CommandTester $commandTester;

    protected function setUp(): void
    {
        $application = new Application();
        $application->add(new ExampleCommand());
        $command = $application->find('app:example');
        $this->commandTester = new CommandTester($command);
    }

    #[NoReturn]
    public function testExecute(): void
    {
        $this->commandTester->execute([]);

        $this->commandTester->assertCommandIsSuccessful();

        dd($this->commandTester->getDisplay());
    }
}
