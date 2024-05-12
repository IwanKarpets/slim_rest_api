<?php

namespace App;

use PHPUnit\Framework\TestCase;
use Slim\Psr7\Factory\ServerRequestFactory;
use Slim\Psr7\Factory\ResponseFactory;

require_once 'app_factory.php';
class LoansApiTest extends TestCase
{
    protected $app;
    protected function setUp(): void
    {
        $this->app = createApp();
    }
    private function createRequestAndHandle($method, $uri, $data = null)
    {
        $request = (new ServerRequestFactory())->createServerRequest($method, $uri);
        if ($data !== null) {
            $request = $request->withParsedBody($data);
        }
        $response = new ResponseFactory();
        return $this->app->handle($request);
    }

    public function testPostLoan()
    {
        $loanData = ['name' => "Vasya",'amount' => 3000];
        $response = $this->createRequestAndHandle('POST', 'api/loans', $loanData);
        $this->assertEquals(201, $response->getStatusCode());
    }

    public function testPostLoanValidation()
    {
        $loanData = ['name' => '', 'amount' => ''];
        $response = $this->createRequestAndHandle('POST', 'api/loans', $loanData);
        $this->assertEquals(422, $response->getStatusCode());
        $responseData = json_decode((string)$response->getBody(), true);
        $this->assertArrayHasKey('name', $responseData);
        $this->assertArrayHasKey('amount', $responseData);
        $this->assertSame('Name is required', $responseData['name'][0]);
        $this->assertSame('Amount is required', $responseData['amount'][0]);
    }


    public function testGetLoanById()
    {
        $response = $this->createRequestAndHandle('GET', '/api/loans/2');
        $this->assertSame(200, $response->getStatusCode());
        $responseData = json_decode((string)$response->getBody(), true);
        $this->assertArrayHasKey('name', $responseData);
        $this->assertArrayHasKey('amount', $responseData);
        $this->assertArrayHasKey('id', $responseData);
        $this->assertSame(2, $responseData['id']);
    }

    public function testGetLoanByNonExistentId()
    {
        $response = $this->createRequestAndHandle('GET', '/api/loans/99999');
        $this->assertSame(404, $response->getStatusCode());
        $responseData = json_decode((string)$response->getBody(), true);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertSame('404 Not Found', $responseData['message']);
    }

    public function testGetLoanByInvalidId()
    {
        $response = $this->createRequestAndHandle('GET', '/api/loans/invalid_id');
        $this->assertSame(404, $response->getStatusCode());
        $responseData = json_decode((string)$response->getBody(), true);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertSame('404 Not Found', $responseData['message']);
    }

    public function testGetLoans()
    {
        $response = $this->createRequestAndHandle('GET', 'api/loans');
        $this->assertSame(200, $response->getStatusCode());
        $responseData = json_decode((string)$response->getBody(), true);
        $this->assertIsArray($responseData);
        $this->assertNotEmpty($responseData);
    }

    public function testPutLoanById()
    {
        $loanId = 2;
        $loanData = ['name' => 'Petya', 'amount' => 4000];
        $response = $this->createRequestAndHandle('PUT', "api/loans/$loanId", $loanData);
        $this->assertEquals(200, $response->getStatusCode());
        $responseData = json_decode((string)$response->getBody(), true);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertSame('Loan updated', $responseData['message']);
    }

    public function testPutLoanByInvalidData()
    {
        $loanId = 2;
        $loanData = ['name' => 'Petya'];
        $response = $this->createRequestAndHandle('PUT', "api/loans/$loanId", $loanData);
        $this->assertEquals(422, $response->getStatusCode());
        $responseData = json_decode((string)$response->getBody(), true);
        $this->assertArrayHasKey('amount', $responseData);
        $this->assertSame('Amount is required', $responseData['amount'][0]);
    }

    public function testDeleteLoanById()
    {
        $loanId = 2;
        $response = $this->createRequestAndHandle('DELETE', "api/loans/$loanId");
        $this->assertEquals(200, $response->getStatusCode());
        $responseData = json_decode((string)$response->getBody(), true);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertSame('Loan deleted', $responseData['message']);
    }
}
