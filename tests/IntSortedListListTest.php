<?php

namespace falmar\DualSortedLinkList\Tests;

use falmar\DualSortedLinkList\Enums\ListTypeEnum;
use falmar\DualSortedLinkList\Exceptions\InvalidTypeException;
use PHPUnit\Framework\TestCase;

class IntSortedListListTest extends TestCase
{
    public function testInsert()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::INTEGER);

        $list->insert(1);
        $list->insert(2);
        $list->insert(3);

        $this->assertEquals(1, $list->getHead()->value);
        $this->assertEquals(2, $list->getHead()->next->value);
        $this->assertEquals(3, $list->getHead()->next->next->value);
    }

    public function testInsertSort()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::INTEGER);

        $list->insert(3);
        $list->insert(1);
        $list->insert(2);

        $this->assertEquals(1, $list->getHead()->value);
        $this->assertEquals(2, $list->getHead()->next->value);
        $this->assertEquals(3, $list->getHead()->next->next->value);
    }

    public function testInsertReverse()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::INTEGER);

        $list->insert(3);
        $list->insert(2);
        $list->insert(1);

        $this->assertEquals(1, $list->getHead()->value);
        $this->assertEquals(2, $list->getHead()->next->value);
        $this->assertEquals(3, $list->getHead()->next->next->value);
    }

    public function testInsertEmpty()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::INTEGER);

        $list->insert(0);
        $this->assertNotNull($list->getHead());
        $this->assertEquals(0, $list->getHead()->value);
    }

    public function testInsertInt()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::INTEGER);
        $this->expectException(InvalidTypeException::class);

        $list->insert('this is a string');
    }

    public function testInsertDuplicateSameNode()
    {
        // duplicate values are allowed, but not duplicate nodes
        $list = new TestableSortedLinkList(ListTypeEnum::INTEGER);

        $list->insert(1);
        $head = $list->getHead();
        $this->assertNotNull($list->getHead());
        $this->assertEquals(1, $list->getHead()->value);

        $list->insert(1);
        $this->assertEquals($head, $list->getHead());
        $this->assertEquals(1, $list->getHead()->value);
    }

    public function testSearchFound()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::INTEGER);
        $list->insert(1);
        $list->insert(2);
        $list->insert(3);

        $nodeA = $list->search(1);
        $this->assertNotNull($nodeA);
        $this->assertEquals(1, $nodeA->value);

        $nodeB = $list->search(2);
        $this->assertNotNull($nodeB);
        $this->assertEquals(2, $nodeB->value);

        $nodeC = $list->search(2);
        $this->assertNotNull($nodeC);
        $this->assertEquals(2, $nodeC->value);
    }

    public function testSearchInt()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::INTEGER);
        $this->expectException(InvalidTypeException::class);

        $list->search('');
    }

    public function testSearchNotFound()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::INTEGER);
        $list->insert(1);
        $list->insert(2);
        $list->insert(3);

        $nodeD = $list->search(5);
        $this->assertNull($nodeD);

        $nodeE = $list->search(100);
        $this->assertNull($nodeE);
    }

    public function testDeleteFromEmptyList()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::INTEGER);
        $this->assertNull($list->delete(5));
    }

    public function testDeleteHeadNode()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::INTEGER);
        $list->insert(1);

        $deletedNode = $list->delete(1);
        $this->assertEquals(1, $deletedNode->value);
        $this->assertNull($list->getHead());

        $list = new TestableSortedLinkList(ListTypeEnum::INTEGER);
        $list->insert(1);
        $list->insert(3);

        $deletedNode = $list->delete(1);
        $this->assertEquals(1, $deletedNode->value);
        $this->assertEquals(3, $list->getHead()->value);
    }

    public function testDeleteMiddleNode()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::INTEGER);
        $list->insert(1);
        $list->insert(3);
        $list->insert(2);

        $deletedNode = $list->delete(2);
        $this->assertEquals(2, $deletedNode->value);
        $this->assertEquals(1, $list->getHead()->value);
        $this->assertEquals(3, $list->getHead()->next->value);
    }

    public function testDeleteNonExistentValue()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::INTEGER);
        $list->insert(1);
        $list->insert(2);
        $list->insert(3);

        $this->assertNull($list->delete(5));
    }

    public function testDisplayEmptyList()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::INTEGER);

        ob_start();
        $list->display();
        $output = ob_get_clean();

        $this->assertEquals('', $output);
    }

    public function testDisplayNonEmptyList()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::INTEGER);
        $list->insert(5);
        $list->insert(10);

        ob_start();
        $list->display();
        $output = ob_get_clean();

        $expectedOutput = "5 -> 10\n";
        $this->assertEquals($expectedOutput, $output);

        $list = new TestableSortedLinkList(ListTypeEnum::INTEGER);
        $list->insert(5);
        $list->insert(15);
        $list->insert(10);

        ob_start();
        $list->display();
        $output = ob_get_clean();

        $expectedOutput = "5 -> 10 -> 15\n";
        $this->assertEquals($expectedOutput, $output);

        $list->insert(35);
        $list->insert(100);
        $list->insert(50);

        ob_start();
        $list->display();
        $output = ob_get_clean();

        $expectedOutput = "5 -> 10 -> 15\n35 -> 50 -> 100\n";
        $this->assertEquals($expectedOutput, $output);
    }
}
