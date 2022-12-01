<?php

declare(strict_types=1);

namespace FW\Core\Type;

class Dictionary implements \IteratorAggregate, \ArrayAccess, \Countable, \JsonSerializable
{
    private bool $readonly;

    private array $container;

    public function __construct($values, bool $readonly = false)
    {
        $this->container = [...$values];
        $this->readonly = $readonly;
    }

    public function get(string $name)
    {
        return isset($this->container[$name]) ?? $this->container[$name];
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this);
    }

    public function offsetSet($offset, $value)
    {
        if ($this->readonly) {
            return;
        }

        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset)
    {
        if ($this->readonly) {
            return;
        }

        unset($this->container[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    public function count(): int
    {
        return count($this->container);
    }

    public function jsonSerialize()
    {
        return $this->container;
    }


    public function set(string $name, string $value)
    {
        if ($this->readonly) {
            return;
        }

        $this->container[$name] = $value;

    }

    public function getValues(): array
    {
        return $this->container;
    }

    public function setValues(array $values)
    {
        if ($this->readonly) {
            return;
        }

        $this->container = [...$this->container, ...$values];
    }

    public function clear()
    {
        if ($this->readonly) {
            return;
        }

        $this->container = [];
    }
}