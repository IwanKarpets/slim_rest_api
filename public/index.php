<?php

use Slim\Factory\AppFactory;
use DI\ContainerBuilder;
use Slim\Handlers\Strategies\RequestResponseArgs;
use App\Middleware\AddJsonResponseHeader;
use App\Middleware\GetLoan;
use Slim\Routing\RouteCollectorProxy;
use App\Controllers\LoanIndex;
use App\Controllers\Loans;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

define('APP_ROOT', dirname(__DIR__));

require APP_ROOT . '/vendor/autoload.php';

$builder = new ContainerBuilder();

$container = $builder->addDefinitions(APP_ROOT . '/config/definitions.php')
                     ->build();

AppFactory::setContainer($container);

$app = AppFactory::create();


$collector = $app->getRouteCollector();

$collector->setDefaultInvocationStrategy(new RequestResponseArgs());

$app->addBodyParsingMiddleware();

$error_middleware = $app->addErrorMiddleware(true, true, true);

$error_handler = $error_middleware->getDefaultErrorHandler();

$error_handler->forceContentType('application/json');

$app->add(new AddJsonResponseHeader());

$app->get('/', function (Request $request, Response $response) {
    return $response->withHeader('Location', '/api/loans')->withStatus(302);
});

$app->group('/api', function (RouteCollectorProxy $group) {
    $group->get('/loans', LoanIndex::class);

    $group->get('/loans/{id:[0-9]+}', Loans::class . ":show")->add(GetLoan::class);

    $group->post('/loans', [Loans::class, 'create']);

    $group->put('/loans/{id:[0-9]+}', Loans::class . ":update")->add(GetLoan::class);

    $group->delete('/loans/{id:[0-9]+}', Loans::class . ":delete")->add(GetLoan::class);
});

$app->run();
