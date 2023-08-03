<?php

namespace falmar\DualSortedLinkList;

use falmar\DualSortedLinkList\Enums\ListTypeEnum;
use falmar\DualSortedLinkList\Enums\OrderTypeEnum;
use falmar\DualSortedLinkList\Exceptions\InvalidTypeException;

class SortedLinkList implements SortedLinkListInterface
{
    protected ?ListTypeEnum $type = null;
    protected OrderTypeEnum $order;
    protected ?Node $head = null;
    protected ?Node $tail = null;

    public function __construct(?ListTypeEnum $type = null, $order = OrderTypeEnum::ASCENDING)
    {
        $this->type = $type;
        $this->order = $order;
    }

    public function insert(int|string $value): Node
    {
        // in case the type was not set, set it now
        // it prefer exposing a provider class to the user
        if (!$this->type) {
            $this->type = is_int($value) ? ListTypeEnum::INTEGER : ListTypeEnum::STRING;
        }

        $this->checkType($value);

        if ($this->head === null) {
            $this->head = new Node($value);
            $this->tail = $this->head;
            return $this->head;
        }

        $previous = null;
        $current = $this->head;

        while ($current) {
            // duplicate values are allowed, but not duplicate nodes
            if ($current->value === $value) {
                return $current;
            }

            // Check sort order and insert accordingly
            $comparison = $this->order === OrderTypeEnum::ASCENDING ? $current->value > $value : $current->value < $value;
            if ($comparison) {
                $node = new Node($value, $current);

                if ($previous) {
                    $previous->next = $node;
                } else {
                    $this->head = $node;
                }

                return $node;
            }

            $previous = $current;
            $current = $current->next;
        }

        // insert after last node
        $this->tail = new Node($value);
        $previous->next = $this->tail;

        return $this->tail;
    }

    public function search(int|string $value): ?Node
    {
        $this->checkType($value);

        $current = $this->head;

        // go around and around and around
        while ($current) {
            if ($current->value === $value) {
                return $current;
            }

            $current = $current->next;
        }

        return null;
    }

    public function delete(int|string $value): ?Node
    {
        $this->checkType($value);

        if ($this->head === null) {
            return null;
        } elseif ($this->head->value === $value) {
            $node = $this->head;
            $this->head = $this->head->next;
            return $node;
        }

        $previous = null;
        $current = $this->head;

        while ($current) {
            if ($current->value === $value) {
                $previous->next = $current->next;

                return $current;
            }

            $previous = $current;
            $current = $current->next;
        }

        return null;
    }

    public function display(): void
    {
        $current = $this->head;

        $count = 0;
        while ($current) {
            $val = $current->value;
            $current = $current->next;

            echo $val;

            if (($count > 0 && ($count) % 2 === 0) || $current === null) {
                $count = 0;
                echo "\n";
                continue;
            }

            echo " -> ";

            $count++;
        }
    }

    protected function checkType(int|string $value): void
    {
        if (!$this->type) {
            // no type set yet, so it will allow search/delete without breaking
            return;
        }

        if ($this->type === ListTypeEnum::STRING && !is_string($value)) {
            throw new InvalidTypeException('invalid type it should be string.');
        } elseif ($this->type === ListTypeEnum::INTEGER && !is_int($value)) {
            throw new InvalidTypeException('invalid type it should be integer.');
        } elseif ($this->type === ListTypeEnum::UNKNOWN) {
            throw new InvalidTypeException('invalid type. unknown type.');
        }
    }
}
