<?php

namespace Noldors\CommerceElements;

use Noldors\CommerceElements\Exceptions\UnsupportedStorageException;
use Noldors\CommerceElements\Interfaces\ElementsResolverInterface;

class Factory
{
    /**
     * Factory constructor.
     */
    private function __construct()
    {
    }

    /**
     * @param string $resolver Resolver class name
     * @param string $type like 'cart'
     * @return ElementsResolverInterface
     * @throws UnsupportedStorageException
     */
    public static function create(string $resolver, string $type): ElementsResolverInterface
    {
        $dataResolver = new $resolver($type);

        if ($dataResolver instanceof ElementsResolverInterface) {
            return $dataResolver;
        }

        throw new UnsupportedStorageException();
    }

}