<?php

namespace exert;

use Redis;

class RedisearchClient
{
    private $host;
    private $port;
    private $redis;

    public function __construct($host, $port = 6379)
    {
        $this->host = $host;
        $this->port = $port;
        $this->redis = new Redis();
    }

    public function connect()
    {
        $this->redis->connect($this->host, $this->port);
    }

    public function make($index)
    {
        $command = $index->makeCommand();
        return $this->redis->rawCommand(...$command);
    }

    public function drop($index, $force = false)
    {
        $name = $index->getName();
        $command = ['FT.DROPINDEX', $name];
        if ($force) {
            $command[] = 'DD';
        }
        return $this->redis->rawCommand(...$command);
    }

    public function query($index, $query)
    {
        $command = $query->makeCommand();
        $command = array_merge(
            ['FT.SEARCH', $index],
            $command);
        var_export($command);
        return $this->redis->rawCommand(...$command);
    }

    public function set($name, $items)
    {
        $command = ['HSET', $name];
        foreach ($items as $k => $v) {
            $command[] = $k;
            $command[] = $v;
        }
        return $this->redis->rawCommand(...$command);
    }

    public function del($name, $items = [])
    {
        $command = [empty($items) ? 'DEL' : 'HDEL', $name];
        $command = array_merge($command, $items);
        return $this->redis->rawCommand(...$command);
    }
}
