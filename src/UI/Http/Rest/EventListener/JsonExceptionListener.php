<?php

declare(strict_types=1);

namespace UI\Http\Rest\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
use Symfony\Component\Serializer\SerializerInterface;
use UI\Http\Rest\Exception\JsonExceptionInterface;
use UI\Http\Rest\Exception\ValidationException;
use function method_exists;

class JsonExceptionListener
{
    const CONTENT_TYPE = 'application/problem+json; charset=utf-8';

    public function __construct(
        private readonly SerializerInterface $serializer)
    {
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        /** @var HttpExceptionInterface $exception */
        $exception = $event->getThrowable();

        if (!$exception instanceof JsonExceptionInterface) {
            return;
        }

        $headers = ['Content-Type' => self::CONTENT_TYPE];

        if ($exception instanceof ValidationException) {
            $event->setResponse(new Response(
                $this->serializer->serialize($exception->getViolationList(), 'json'),
                $exception->getStatusCode(),
                $headers
            ));

            return;
        }

        $previous = $exception->getPrevious();
        $detail = $previous->getMessage();

        $violations = [];
        $errors = method_exists($previous, 'getErrors') ? $previous->getErrors() : [$previous];
        foreach ($errors as $error) {
            if ($error instanceof NotNormalizableValueException) {
                $violations[] = [
                    'propertyPath' => $error->getPath(),
                    'message' => sprintf('This value should be of type %s', $error->getExpectedTypes()[0]),
                    'currentType' => $error->getCurrentType(),
                ];
            }
        }

        $data = [
            'title' => $exception->getMessage(),
            'detail' => empty($violations) ? $detail : 'Data error',
            'violations' => $violations
        ];

        $event->setResponse(new JsonResponse($data, $exception->getStatusCode(), $headers));
    }
}

