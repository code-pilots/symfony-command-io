<?php

declare(strict_types=1);

namespace CodePilots\SymfonyCommandIo;

use Symfony\Component\Console\Style\SymfonyStyle;

final class CommandStyle extends SymfonyStyle
{
    protected string $prefix = '';

    public function writelnPrefix(string|iterable $messages, int $type = self::OUTPUT_NORMAL): void
    {
        if (!is_iterable($messages)) {
            $messages = [$messages];
        }

        /** @psalm-suppress MixedAssignment */
        foreach ($messages as $key => $message) {
            /** @psalm-suppress PossiblyInvalidArrayAssignment, MixedArrayOffset, MixedOperand */
            $messages[$key] = $this->getPrefix() . $message;
        }

        $this->writeln($messages, $type);
    }

    public function setPrefix(string $prefix): void
    {
        $this->prefix = $prefix;
    }

    private function getPrefix(): string
    {
        return sprintf('[%s]%s ', (new \DateTime())->format('Y-m-d H:i:s.v'), $this->prefix);
    }
}
