<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestService
{
    private const FORMAT = 'json';

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(
        SerializerInterface $serializer,
        RequestStack $requestStack,
        ValidatorInterface $validator
    )
    {
        $this->serializer = $serializer;
        $this->requestStack = $requestStack;
        $this->validator = $validator;
    }
    public function getRequestBody(string $type): object
    {
        $context['allow_extra_attributes'] = false;
        $content = $this->requestStack->getCurrentRequest()->getContent();
        $body = $this->serializer->deserialize($content, $type, self::FORMAT, $context);
        $errors = $this->validator->validate($body);
        if (count($errors) > 0) {
            return $this->errorsResponse($errors);
        }
        return $body;
    }

    private function errorsResponse(ConstraintViolationList $errors): JsonResponse
    {
        $violations = [];
            foreach ($errors as $violation) {
                $violations[$violation->getPropertyPath()] = $violation->getMessage();
            }
        $response = new JsonResponse();
        $response->setData($violations);
        return $response;
    }
}