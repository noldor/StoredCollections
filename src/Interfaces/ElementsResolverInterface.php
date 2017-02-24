<?php

namespace Noldors\CommerceElements\Interfaces;


use Illuminate\Support\Collection;

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
     * Add element to collection.
     * @param int $id
     * @param array $data
     * @return ElementsResolverInterface
     */
    public function add(int $id, array $data): self;

    /**
     * Delete element from collection.
     *
     * @param $id
     * @return ElementsResolverInterface
     */
    public function delete(int $id): self;

    /**
     * Change element.
     *
     * @param int $id
     * @param array $data
     * @return ElementsResolverInterface
     */
    public function update(int $id, array $data): self;

    /**
     * Get collection.
     *
     * @return Collection
     */
    public function collection(): Collection;

    /**
     * Get collection as array.
     *
     * @return array
     */
    public function toArray(): array;

    /**
     * Convert to array only collection, do not convert nested objects.
     *
     * @return array
     */
    public function all(): array;

    /**
     * Get summary of some field.
     * @param $field
     * @return mixed
     */
    public function getTotal($field);
}