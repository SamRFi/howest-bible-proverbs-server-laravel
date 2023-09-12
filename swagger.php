<?php

require_once 'vendor/autoload.php';

$generator = new \OpenApi\Generator();
$openapi = $generator->generate(['routes']);
header('Content-Type: application/json');
echo $openapi->toJson();
