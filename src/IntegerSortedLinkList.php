<?php

namespace falmar\DualSortedLinkList;

use falmar\DualSortedLinkList\Enums\ListTypeEnum;

class IntegerSortedLinkList implements SortedLinkListInterface
{
    private ListTypeEnum $type;
    private ?Node $head = null;

    public function __construct(ListTypeEnum $type)
    {
        $this->type = $type;
    }

    public function getHead(): ?Node
    {
        return null;
    }

    public function insert(int|string $value): Node
    {
        return new Node(0);
    }

    public function search(int|string $value): ?Node
    {
        // TODO: Implement search() method.
        return null;
    }

    public function delete(int|string $value): ?Node
    {
        // TODO: Implement delete() method.
        return null;
    }

    public function display(): void
    {
        // TODO: Implement display() method.
    }
}
