<?php

use Swoole\Http\Server;
use Swoole\Http\Request;
use Swoole\Http\Response;

$host = '0.0.0.0';
$hostname = 'flux-eco-manager';
$port = '9500';

$server = new Server($host, $port);

$server->on('start', function (Server $server) use ($hostname, $port) {
    echo sprintf('Swoole HTTP server is started at http://%s:%s' . PHP_EOL, $hostname, $port);

});

$server->on('request', function (Request $request, Response $response) {

});

$server->start();
