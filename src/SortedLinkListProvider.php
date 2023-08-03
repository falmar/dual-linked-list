<?php

namespace falmar\DualSortedLinkList;

use falmar\DualSortedLinkList\Enums\ListTypeEnum;
use falmar\DualSortedLinkList\Exceptions\InvalidType;

class SortedLinkListProvider
{
    public static function makeList(ListTypeEnum $type): SortedLinkListInterface
    {
        if ($type === ListTypeEnum::INTEGER) {
            return new IntegerSortedLinkList($type);
        } elseif ($type === ListTypeEnum::STRING) {
            return new StringSortedLinkList($type);
        }

        throw new InvalidType('invalid type.');
    }
}
