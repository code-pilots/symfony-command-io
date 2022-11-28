<?php

declare(strict_types=1);

namespace CodePilots\SymfonyCommandIo;

final class Microtime
{
    private readonly float $start;

    public function __construct()
    {
        $this->start = microtime(true);
    }

    public static function start(callable $determine = null): Microtime
    {
        $microTime = new self();
        null !== $determine && $determine();

        return $microTime;
    }

    public function finishTime(): \DateTimeImmutable
    {
        $uTime = sprintf('%.4f', microtime(true) - $this->start);

        return \DateTimeImmutable::createFromFormat('U.u', $uTime) ?:
            throw new \LogicException('Invalid start argument, excepted microtime(true) format');
    }

    public function finishTimeFormat(): string
    {
        return $this->finishTime()->format('H:i:s.v');
    }
}
