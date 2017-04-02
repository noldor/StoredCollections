<?php

namespace Noldors\CommerceElements\Tests;


use Noldors\Contracts\Arrayable;

class Helper implements Arrayable
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function toArray():array
    {
        return ['data' => $this->data];
    }

    public function jsonSerialize():array
    {
        return $this->toArray();
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->data);
    }
}