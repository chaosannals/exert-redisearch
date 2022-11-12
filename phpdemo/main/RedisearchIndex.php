<?php

namespace exert;

class RedisearchIndex
{
    private $name;
    private $defines;
    private $langurage;

    public function __construct($name, $langurage = 'chinese')
    {
        $this->name = $name;
        $this->defines = [];
        $this->langurage = $langurage;
    }

    public function defineText($name, $weight = null, $sortable = false)
    {
        $result = [$name, 'TEXT'];
        if (isset($weight)) {
            $result[] = 'WEIGHT';
            $result[] = $weight;
        }
        if ($sortable) {
            $result[] = 'SORTABLE';
        }
        $this->defines[] = $result;
        return $this;
    }

    public function defineNumeric($name, $weight = null, $sortable = false)
    {
        $result = [$name, 'NUMERIC'];
        if (isset($weight)) {
            $result[] = 'WEIGHT';
            $result[] = $weight;
        }
        if ($sortable) {
            $result[] = 'SORTABLE';
        }
        return $this;
    }

    public function defineGEO($name, $sortable = false)
    {
        $result = [$name, 'GEO'];
        if ($sortable) {
            $result[] = 'SORTABLE';
        }
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function makeCommand()
    {
        $result = [
            'FT.CREATE', $this->name, 'ON', 'HASH',
            'PREFIX', '1', 'doc:',
            'LANGUAGE', $this->langurage,
            'SCHEMA'
        ];
        return array_reduce($this->defines, 'array_merge', $result);
    }
}
