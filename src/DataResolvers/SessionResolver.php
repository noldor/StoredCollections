<?php

namespace Noldors\CommerceElements\DataResolvers;

use Illuminate\Support\Collection;

/**
 * Class SessionResolver
 * @package Noldors\CommerceElements\DataResolvers
 */
class SessionResolver extends Resolver
{
    /**
     * SessionResolver constructor.
     *
     * @param string $type
     */
    public function __construct(string $type)
    {
        $this->items = new Collection($_SESSION[$type] ?? []);
        $this->type = $type;
    }

    /**
     * In this case, it save collection to session.
     */
    public function __destruct()
    {
        $_SESSION[$this->type] = $this->items->toArray();
    }
}