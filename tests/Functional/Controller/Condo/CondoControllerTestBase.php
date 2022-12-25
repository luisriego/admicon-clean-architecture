<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller\Condo;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Tests\Functional\Controller\ControllerTestBase;

class CondoControllerTestBase extends ControllerTestBase
{
    protected const CREATE_CONDO_ENDPOINT = '/api/condos/create';
    protected const NON_EXISTING_CONDO_ID = 'e0a1878f-dd52-4eea-959d-96f589a9f234';
    protected const CREATE_USER_ENDPOINT = '/api/users/create';

    protected function createCondo(): string
    {
        $payload = [
            'taxpayer' => '02024517000146',
            'fantasyName' => 'Condomínio Matilda',
        ];

        self::$client->request(Request::METHOD_POST, self::CREATE_CONDO_ENDPOINT, [], [], [], \json_encode($payload));

        $response = self::$client->getResponse();

        if (Response::HTTP_CREATED !== $response->getStatusCode()) {
            throw new \RuntimeException('Error creating condo');
        }

        $responseData = $this->getResponseData($response);

        return $responseData['condoId'];
    }

    protected function createUser(): string
    {
        $payload = [
            'name' => 'Peter',
            'email' => 'peter@api.com',
            'password' => 'Fake123',
            'age' => 30,
        ];

        self::$client->request(Request::METHOD_POST, self::CREATE_USER_ENDPOINT, [], [], [], \json_encode($payload));

        $response = self::$client->getResponse();

        if (Response::HTTP_CREATED !== $response->getStatusCode()) {
            throw new \RuntimeException('Error creating user');
        }

        $responseData = $this->getResponseData($response);

        return $responseData['userId'];
    }
}