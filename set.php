<?php

use exert\RedisearchClient;

require __DIR__ . '/vendor/autoload.php';

$client = new RedisearchClient('127.0.0.1', 16379);
$client->connect();
$r = $client->set('doc:1', [
    'body' => 'aaa',
    'title' => 'bbb',
    'url' => 'http://example.com',
    'price' => 123.23
]);
echo $r;
$r = $client->set('doc:3', [
    'body' => '中文2',
    'title' => '中文标题13',
    'url' => 'http://example.cn',
    'price' => 123.23
]);
echo $r;
$r = $client->set('doc:5', [
    'body' => '中文测试2',
    'title' => '中文标题13',
    'url' => 'http://example.cn',
    'price' => 123.23
]);
echo $r;