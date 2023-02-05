<?php

declare(strict_types=1);

namespace UI\Http\Rest\ArgumentResolver;

use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use UI\Http\Rest\Input\Shared\InputInterface;
use UI\Http\Rest\Exception\DeserializationFailedException;
use UI\Http\Rest\Exception\ValidationException;

class InputArgumentValueResolver implements ArgumentValueResolverInterface
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly ValidatorInterface $validator
    ) {
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return is_subclass_of($argument->getType(), InputInterface::class);
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        yield $this->createFromRequest($request, $argument);
    }

    private function createFromRequest(Request $request, ArgumentMetadata $argument): InputInterface
    {
        try {
            $input = $this->serializer->deserialize($request->getContent(), $argument->getType(), 'json');
        } catch (Exception $e) {
            throw new DeserializationFailedException('Deserialization failed.', $e);
        }

        $validationConstraints = $this->validator->validate($input);

        if ($validationConstraints->count() > 0) {
            throw new ValidationException($validationConstraints);
        }

        return $input;
    }
}

