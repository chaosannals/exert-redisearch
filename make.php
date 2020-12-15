<?php

use exert\RedisearchClient;
use exert\RedisearchIndex;

require __DIR__ . '/vendor/autoload.php';

$index = new RedisearchIndex('myIdx');
$index->defineText('title', 5.0, true)
    ->defineText('body')
    ->defineText('url')
    ->defineNumeric('price', null, true);

$client = new RedisearchClient('127.0.0.1', 16379);
$client->connect();
$r = $client->make($index);
echo $r;
