<?php

use App\Database;
use App\Repositories\LoanRepository;

$url = getenv("CLEARDB_DATABASE_URL") ? parse_url(getenv("CLEARDB_DATABASE_URL")) : null;

$server = $url ? $url["host"] : '127.0.0.1';
$username = $url ? $url["user"] : 'root';
$password = $url ? $url["pass"] : '';
$db = $url ? substr($url["path"], 1) : 'rest_api';

return [
    Database::class => function () use ($server, $db, $username, $password) {

        return new Database($server, $db, $username, $password);
    },
    LoanRepository::class => function ($container) {

        return new LoanRepository($container->get(Database::class));
    }
];
