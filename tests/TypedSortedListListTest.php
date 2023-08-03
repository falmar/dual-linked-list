<?php

namespace falmar\DualSortedLinkList\Tests;

use falmar\DualSortedLinkList\Enums\ListTypeEnum;
use falmar\DualSortedLinkList\Exceptions\InvalidTypeException;
use PHPUnit\Framework\TestCase;

class TypedSortedListListTest extends TestCase
{
    public function testWithType () {
        $list = new TestableSortedLinkList(ListTypeEnum::STRING);

        $this->assertEquals(ListTypeEnum::STRING, $list->getType());

        $list = new TestableSortedLinkList(ListTypeEnum::INTEGER);
        $this->assertEquals(ListTypeEnum::INTEGER, $list->getType());

        $list = new TestableSortedLinkList(ListTypeEnum::UNKNOWN);
        $this->assertEquals(ListTypeEnum::UNKNOWN, $list->getType());
    }

    public function testUnknown()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::UNKNOWN);

        $this->expectException(InvalidTypeException::class);
        $list->insert('a');
    }

    public function testInsertString()
    {
        $list = new TestableSortedLinkList(null);

        $list->insert('a');
        $this->assertEquals(ListTypeEnum::STRING, $list->getType());
    }

    public function testInsertInteger()
    {
        $list = new TestableSortedLinkList(null);

        $list->insert(1);
        $this->assertEquals(ListTypeEnum::INTEGER, $list->getType());
    }

    public function testTypelessSearch () {
        $list = new TestableSortedLinkList(null);

        $node = $list->search('a');
        $this->assertNull($node);

        $list->insert(10);
        $node = $list->search(10);
    }
}
