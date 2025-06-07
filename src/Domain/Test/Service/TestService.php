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
}
