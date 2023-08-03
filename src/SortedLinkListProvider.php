<?php

namespace falmar\DualSortedLinkList;

use falmar\DualSortedLinkList\Enums\ListTypeEnum;

class SortedLinkListProvider
{
    public static function makeList(ListTypeEnum $type): SortedLinkListInterface
    {
        if ($type === ListTypeEnum::UNKNOWN) {
            throw new Exceptions\InvalidTypeException('invalid type. unknown type.');
        }

        return new SortedLinkList($type);
    }
}
