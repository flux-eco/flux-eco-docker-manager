<?php

require_once '../app/vendor/autoload.php';

use FluxEco\DockerManager;

$api = DockerManager\Api::new(DockerManager\Adapters\Configs::new(__DIR__ . '/ilias-composer'));
$api->provideApplicationSourceFiles();