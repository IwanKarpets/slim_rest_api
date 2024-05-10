<?php

use App\Controllers\LoanIndex;
use App\Controllers\Loans;
use App\Middleware\AddJsonResponseHeader;
use App\Middleware\GetLoan;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\Handlers\Strategies\RequestResponseArgs;
use Slim\Routing\RouteCollectorProxy;

define('APP_ROOT', dirname(__DIR__));

require APP_ROOT . '/vendor/autoload.php';


function createApp()
{
    $builder = new ContainerBuilder();

    $container = $builder->addDefinitions(APP_ROOT . '/config/definitions.php')
                     ->build();

    AppFactory::setContainer($container);
    $app = AppFactory::create();

    $app->getRouteCollector()->setDefaultInvocationStrategy(new RequestResponseArgs());

    $app->addBodyParsingMiddleware();

    $app->add(new AddJsonResponseHeader());

    $errorMiddleware = $app->addErrorMiddleware(true, true, true);
    $errorHandler = $errorMiddleware->getDefaultErrorHandler();
    $errorHandler->forceContentType('application/json');

    $app->group('/api', function (RouteCollectorProxy $group) {
        $group->get('/loans', LoanIndex::class);
        $group->get('/loans/{id:[0-9]+}', Loans::class . ":show")->add(GetLoan::class);
        $group->post('/loans', [Loans::class, 'create']);
        $group->put('/loans/{id:[0-9]+}', Loans::class . ":update")->add(GetLoan::class);
        $group->delete('/loans/{id:[0-9]+}', Loans::class . ":delete")->add(GetLoan::class);
    });

    return $app;
}
