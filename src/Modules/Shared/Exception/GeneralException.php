<?php

declare(strict_types=1);

namespace App\Modules\Shared\Exception;

use Exception;
use Throwable;

class GeneralException extends Exception
{
    private function __construct(string $message = '')
    {
        parent::__construct($message);
    }

    public static function create(string $action, string $message, array $parameters = [], ?Throwable $previous = null): static
    {
        $copiedParameters = $parameters;
        array_walk($copiedParameters, function (&$value, $key) {
            $value = "{$key} = {$value}";
        });

        $message = sprintf(
            'Action: %s %sError message: %s %sParameters: %s %s',
            $action,
            PHP_EOL,
            $message,
            PHP_EOL,
            implode(', ', $copiedParameters),
            PHP_EOL
        );

        if ($previous) {
            $message .= sprintf(
                'Previous exception message: %s %sPrevious exception trace: %s',
                $previous->getMessage(),
                PHP_EOL,
                $previous->getTraceAsString()
            );
        }

        return new static($message);
    }

    public static function message(string $action, string $message, array $parameters = [], ?Throwable $previous = null): string
    {
        $instance = static::create($action, $message, $parameters, $previous);

        return $instance->getMessage();
    }
}
