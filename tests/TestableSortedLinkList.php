<?php

namespace falmar\DualSortedLinkList\Tests;

use falmar\DualSortedLinkList\Enums\ListTypeEnum;
use falmar\DualSortedLinkList\Node;
use falmar\DualSortedLinkList\SortedLinkList;

class TestableSortedLinkList extends SortedLinkList
{
    public function getHead(): ?Node
    {
        return $this->head;
    }

    public function getType(): ListTypeEnum
    {
        return $this->type;
    }
}
