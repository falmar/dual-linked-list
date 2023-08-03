<?php

namespace falmar\DualSortedLinkList\Tests;

use falmar\DualSortedLinkList\Enums\ListTypeEnum;
use falmar\DualSortedLinkList\StringSortedLinkList;
use PHPUnit\Framework\TestCase;

class StringSortedListListTest extends TestCase
{
    public function testInsert()
    {
        $list = new StringSortedLinkList(ListTypeEnum::STRING);

        $list->insert('a');
        $list->insert('b');
        $list->insert('c');

        $this->assertEquals('a', $list->getHead()->getValue());
        $this->assertEquals('b', $list->getHead()->getNext()->getValue());
        $this->assertEquals('c', $list->getHead()->getNext()->getNext()->getValue());
    }

    public function testInsertReverse()
    {
        $list = new StringSortedLinkList(ListTypeEnum::STRING);

        $list->insert('c');
        $list->insert('b');
        $list->insert('a');

        $this->assertEquals('a', $list->getHead()->getValue());
        $this->assertEquals('b', $list->getHead()->getNext()->getValue());
        $this->assertEquals('c', $list->getHead()->getNext()->getNext()->getValue());
    }

    public function testInsertDuplicateSameNode()
    {
        // duplicate values are allowed, but not duplicate nodes

        $list = new StringSortedLinkList(ListTypeEnum::STRING);

        $list->insert('a');
        $head = $list->getHead();
        $this->assertNotNull($list->getHead());
        $this->assertEquals('a', $list->getHead()->getValue());

        $list->insert('a');
        $this->assertEquals($head, $list->getHead());
        $this->assertEquals('a', $list->getHead()->getValue());
    }
}
