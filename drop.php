<?php

use exert\RedisearchClient;
use exert\RedisearchIndex;

require __DIR__ . '/vendor/autoload.php';

$index = new RedisearchIndex('myIdx');
$client = new RedisearchClient('127.0.0.1', 16379);
$client->connect();
$r = $client->drop($index, true);
echo $r;
