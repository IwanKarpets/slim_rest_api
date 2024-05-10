<?php

use App\Database;
use App\Repositories\LoanRepository;

return [
    Database::class => function () {

        return new Database('127.0.0.1', 'rest_api', 'root', '');
    },
    LoanRepository::class => function ($container) {

        return new LoanRepository($container->get(Database::class));
    }
];
