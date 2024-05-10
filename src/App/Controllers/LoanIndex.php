<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Repositories\LoanRepository;

class LoanIndex
{
    public function __construct(private LoanRepository $repository)
    {
    }

    public function __invoke(Request $request, Response $response): Response
    {

        $params = $request->getQueryParams();


        $startDate = $params['start_date'] ?? null;
        $endDate = $params['end_date'] ?? null;
        $minAmount = $params['min_amount'] ?? null;
        $maxAmount = $params['max_amount'] ?? null;


        $data = $this->repository->getAll($startDate, $endDate, $minAmount, $maxAmount);

        $body = json_encode($data);

        $response->getBody()->write($body);

        return $response;
    }
}
