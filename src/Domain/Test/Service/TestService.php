<?php
declare(strict_types=1);

namespace App\Domain\Test\Service;

use DateTimeImmutable;
use Exception;

class TestService
{

    public function __construct(
    ) {
    }

    /**
     * @return DateTimeImmutable
     * @throws Exception
     */
    public function getDateTime(): DateTimeImmutable
    {
        return new DateTimeImmutable();
    }

    public function getHello(): string
    {
        $string = 'Hello world';

        return $string;
    }


    public function getBye(): string
    {
        $retezec = 'Bye world';

        return $retezec;
    }

    public function getGreating(string $string): string
    {
        $retezec = $string . ' world';

        return $retezec;
    }

    public function add(int $num1, int $num2): int
    {
        return $num1 + $num2;
    }
}
