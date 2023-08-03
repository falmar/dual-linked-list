<?php

namespace falmar\DualSortedLinkList\Tests;

class SortedLinkListProviderTest extends \PHPUnit\Framework\TestCase
{
    public function testMakeStringList()
    {
        $this->assertInstanceOf(
            \falmar\DualSortedLinkList\SortedLinkListInterface::class,
            \falmar\DualSortedLinkList\SortedLinkListProvider::makeList(
                type: \falmar\DualSortedLinkList\Enums\ListTypeEnum::INTEGER
            )
        );
    }

    public function testMakeIntegerList()
    {
        $this->assertInstanceOf(
            \falmar\DualSortedLinkList\SortedLinkListInterface::class,
            \falmar\DualSortedLinkList\SortedLinkListProvider::makeList(
                type: \falmar\DualSortedLinkList\Enums\ListTypeEnum::STRING
            )
        );
    }

    public function testMakeInvalidList()
    {
        // just for correctness
        $this->expectException(\falmar\DualSortedLinkList\Exceptions\InvalidTypeException::class);
        \falmar\DualSortedLinkList\SortedLinkListProvider::makeList(
            type: \falmar\DualSortedLinkList\Enums\ListTypeEnum::UNKNOWN
        );
    }
}
