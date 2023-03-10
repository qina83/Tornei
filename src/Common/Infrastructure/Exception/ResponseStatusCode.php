<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Exception;

use Symfony\Component\HttpFoundation\Response;

class ResponseStatusCode
{
    public function __construct(private array $exceptionStatusCodeMap)
    {
    }

    public function codeByException(\Throwable $exception): int
    {
        $shortClassName = (new \ReflectionClass($exception))->getShortName();

        /** @var int $statusCode */
        foreach ($this->exceptionStatusCodeMap as $exceptionMap => $statusCode) {
            if ($shortClassName === $exceptionMap) {
                return $statusCode;
            }
        }

        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}
