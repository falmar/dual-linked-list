<?php

namespace falmar\DualSortedLinkList;

class Node
{
    private ?Node $next = null;
    private string|int $value;

    public function __construct(string|int $value, ?Node $next = null)
    {
        $this->value = $value;
        $this->next = $next;
    }

    public function getNext(): ?Node
    {
        return $this->next;
    }

    public function getValue(): string|int
    {
        return $this->value;
    }
}
