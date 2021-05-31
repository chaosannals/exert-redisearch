<?php

use exert\RedisearchClient;
use exert\RedisearchQuery;

require __DIR__ . '/vendor/autoload.php';

$query = new RedisearchQuery("@body:中文标题 | @title:2");
$client = new RedisearchClient('127.0.0.1', 16379);
$client->connect();
$r = $client->query('myIdx', $query);
var_export($r);
