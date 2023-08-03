<?php

namespace falmar\DualSortedLinkList;

use falmar\DualSortedLinkList\Enums\ListTypeEnum;
use falmar\DualSortedLinkList\Enums\OrderEnum;

class SortedLinkListProvider
{
    public static function makeList(
        ListTypeEnum $type,
        OrderEnum $order = OrderEnum::ASCENDING
    ): SortedLinkListInterface {
        if ($type === ListTypeEnum::UNKNOWN) {
            throw new Exceptions\InvalidTypeException('invalid type. unknown type.');
        }

        return new SortedLinkList($type, $order);
    }
}
