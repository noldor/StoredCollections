<?php

namespace Noldors\CommerceElements\DataResolvers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Noldors\CommerceElements\Interfaces\ElementsResolverInterface;

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
     * SessionResolver constructor.
     * @param string $type
     */
    abstract public function __construct(string $type);

    /**
     * Add element to collection.
     * @param int $id
     * @param array $data
     * @return ElementsResolverInterface
     */
    public function add(int $id, array $data): ElementsResolverInterface
    {
        $this->items->put($id, $data);

        return $this;
    }

    /**
     * Delete element from collection.
     *
     * @param $id
     * @return ElementsResolverInterface
     */
    public function delete(int $id): ElementsResolverInterface
    {
        $this->items->forget($id);

        return $this;
    }

    /**
     * Change element.
     *
     * @param int $id
     * @param array $data
     * @return ElementsResolverInterface
     */
    public function update(int $id, array $data): ElementsResolverInterface
    {
        $this->add($id, array_merge($this->items->get($id), $data));

        return $this;
    }

    /**
     * Get collection.
     *
     * @return Collection
     */
    public function collection(): Collection
    {
        return $this->items;
    }

    /**
     * Get collection as array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_map(function ($value) {
            return $value instanceof Arrayable ? $value->toArray() : array_map(function ($value) {
                return $value instanceof Arrayable ? $value->toArray() : $value;
            }, $value);
        }, $this->items->all());
    }

    /**
     * Convert to array only collection, do not convert nested objects.
     *
     * @return array
     */
    public function all(): array
    {
        return $this->items->all();
    }

    /**
     * Get summary of some field.
     * @param $field
     * @return mixed
     */
    public function getTotal($field)
    {
        return $this->items->sum($field);
    }
}