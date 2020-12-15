<?php

use exert\RedisearchClient;

require __DIR__ . '/vendor/autoload.php';

$client = new RedisearchClient('127.0.0.1', 16379);
$client->connect();
$r = $client->del('doc:1');
echo $r;
