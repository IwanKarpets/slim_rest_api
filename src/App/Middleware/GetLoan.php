<?php

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteContext;
use App\Repositories\LoanRepository;
use Slim\Exception\HttpNotFoundException;

class GetLoan
{
    public function __construct(private LoanRepository $repository)
    {
    }

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $context = RouteContext::fromRequest($request);
        $route = $context->getRoute();
        $id = $route->getArgument('id');
        $singleLoan = $this->repository->getById((int) $id);
        if ($singleLoan === false) {
            throw new HttpNotFoundException($request, message: 'loan not found');
        }

        $request = $request->withAttribute('loan', $singleLoan);
        return $handler->handle($request);
    }
}
