# symfony-command-io
IO style (prefix pid)

## Installation

Install the latest version with

```bash
$ composer require code-pilots/symfony-command-io
```

## Basic Usage

### Example:
```php
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
```

Output:
```
[2022-11-23 11:24:27.988][2136297] Command app:example starting
[2022-11-23 11:24:27.989][2136297] done!
[2022-11-23 11:24:27.989][2136297] Command complete, exec time: 00:00:00.004, memory: 6.0 MiB
```

## For contributors

### Run tests
Exec: `./vendor/bin/phpunit`

### Run lint
Exec phpstan: `./vendor/bin/phpstan analyse src tests`

Exec psalm: `./vendor/bin/psalm`

Exec php-cs-fixer: './vendor/bin/php-cs-fixer fix --verbose'
