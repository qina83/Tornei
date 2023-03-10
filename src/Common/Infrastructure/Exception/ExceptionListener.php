<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Exception;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    public function __construct(
        private ResponseStatusCode $responseStatusCode
    ) {
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof HttpExceptionInterface) {
            return;
        }

        $message = $exception->getMessage();

        $response = new JsonResponse($message);
        $response->setStatusCode($this->responseStatusCode->codeByException($exception));

        $event->setResponse($response);
    }
}
