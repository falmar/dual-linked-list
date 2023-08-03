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
        $this->expectException(\falmar\DualSortedLinkList\Exceptions\InvalidType::class);
        \falmar\DualSortedLinkList\SortedLinkListProvider::makeList(
            type: \falmar\DualSortedLinkList\Enums\ListTypeEnum::UNKNOWN
        );
    }
}
