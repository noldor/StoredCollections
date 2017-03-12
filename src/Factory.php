<?php

namespace Noldors\CommerceElements;

use Noldors\CommerceElements\Exceptions\UnsupportedStorageException;
use Noldors\CommerceElements\Interfaces\ElementsResolverInterface;

/**
 * Class Factory
 * @package Noldors\CommerceElements
 */
class Factory
{
    /**
     * Session resolver.
     */
    const SESSION = 'Noldors\CommerceElements\DataResolvers\SessionResolver';

    /**
     * Cookies resolver.
     */
    const COOKIES = 'Noldors\CommerceElements\DataResolvers\SessionResolver';

    /**
     * Create commerce elements instance.
     *
     * @param string $resolver Resolver class name
     * @param string $type like 'cart'
     * @return ElementsResolverInterface
     * @throws UnsupportedStorageException
     */
    public function create(string $resolver, string $type): ElementsResolverInterface
    {
        $dataResolver = new $resolver($type);

        if ($dataResolver instanceof ElementsResolverInterface) {
            return $dataResolver;
        }

        throw new UnsupportedStorageException();
    }

}