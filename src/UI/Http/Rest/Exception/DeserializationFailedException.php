<?php

declare(strict_types=1);

namespace UI\Http\Rest\Exception;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class DeserializationFailedException extends BadRequestHttpException implements JsonExceptionInterface
{

}

