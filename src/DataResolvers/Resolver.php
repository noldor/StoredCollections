<?php

namespace Noldors\CommerceElements\DataResolvers;

use Noldors\Helpers\Collection;
use Noldors\CommerceElements\Interfaces\ElementsResolverInterface;

/**
 * Class Resolver
 * @package Noldors\CommerceElements\DataResolvers
 */
abstract class Resolver implements ElementsResolverInterface
{
    /**
     * Collection of elements.
     *
     * @var Collection
     */
    protected $items;

    /**
     * Type of data, maybe 'cart' or 'viewed'.
     * @var string
     */
    protected $type;

    /**
     * Constructor.
     * @param string $type
     */
    abstract public function __construct(string $type);

    /**
     * Get collection of elements.
     *
     * @return Collection
     */
    public function collection(): Collection
    {
        return $this->items;
    }

    /**
     * Get collection of elements. Alias for collection.
     *
     * @return \Noldors\Helpers\Collection
     */
    public function all(): Collection
    {
        return $this->collection();
    }
}