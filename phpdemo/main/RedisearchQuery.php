<?php

namespace exert;

class RedisearchQuery
{
    private $query;
    private $language;

    public function __construct($query)
    {
        $this->query = $query;
        $this->language = 'chinese';
    }

    public function setlanguage($language)
    {
        $this->language = $language;
    }

    public function makeCommand()
    {
        $result = ["{$this->query}"];
        $result[] = 'LANGUAGE';
        $result[] = $this->language;
        return $result;
    }
}
