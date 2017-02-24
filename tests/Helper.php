<?php

namespace Noldors\CommerceElements\Tests;


use Illuminate\Contracts\Support\Arrayable;

class Helper implements Arrayable
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function toArray()
    {
        return ['data' => $this->data];
    }
}