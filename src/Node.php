<?php

namespace falmar\DualSortedLinkList;

class Node
{
    public ?Node $next = null;
    public string|int $value;

    public function __construct(string|int $value, ?Node $next = null)
    {
        $this->value = $value;
        $this->next = $next;
    }
}
