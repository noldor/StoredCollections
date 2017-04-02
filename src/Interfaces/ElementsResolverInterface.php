<?php

namespace Noldors\CommerceElements\Interfaces;


use Noldors\Helpers\Collection;

/**
 * Interface ElementsResolverInterface
 * @package Noldors\CommerceElements\Interfaces
 */
interface ElementsResolverInterface
{
    /**
     * Get collection from storage.
     * @param string $type
     */
    public function __construct(string $type);

    /**
     * Used to save collection to storage.
     */
    public function __destruct();

    /**
     * Get collection.
     *
     * @return Collection
     */
    public function collection(): Collection;
}