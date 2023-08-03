<?php

namespace falmar\DualSortedLinkList\Tests;

use falmar\DualSortedLinkList\Enums\ListTypeEnum;
use falmar\DualSortedLinkList\Exceptions\InvalidTypeException;
use PHPUnit\Framework\TestCase;

class StringSortedListListTest extends TestCase
{
    public function testInsert()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::STRING);

        $list->insert('a');
        $list->insert('b');
        $list->insert('c');

        $this->assertEquals('a', $list->getHead()->value);
        $this->assertEquals('b', $list->getHead()->next->value);
        $this->assertEquals('c', $list->getHead()->next->next->value);
    }

    public function testInsertReverse()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::STRING);

        $list->insert('c');
        $list->insert('b');
        $list->insert('a');

        $this->assertEquals('a', $list->getHead()->value);
        $this->assertEquals('b', $list->getHead()->next->value);
        $this->assertEquals('c', $list->getHead()->next->next->value);
    }

    public function testInsertEmpty()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::STRING);

        $list->insert('');
        $this->assertNotNull($list->getHead());
        $this->assertEquals('', $list->getHead()->value);
    }

    public function testInsertInt()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::STRING);
        $this->expectException(InvalidTypeException::class);

        $list->insert(1);
    }

    public function testInsertDuplicateSameNode()
    {
        // duplicate values are allowed, but not duplicate nodes
        $list = new TestableSortedLinkList(ListTypeEnum::STRING);

        $list->insert('a');
        $head = $list->getHead();
        $this->assertNotNull($list->getHead());
        $this->assertEquals('a', $list->getHead()->value);

        $list->insert('a');
        $this->assertEquals($head, $list->getHead());
        $this->assertEquals('a', $list->getHead()->value);
    }

    public function testSearchFound()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::STRING);
        $list->insert('a');
        $list->insert('b');
        $list->insert('c');

        $nodeA = $list->search('a');
        $this->assertNotNull($nodeA);
        $this->assertEquals('a', $nodeA->value);

        $nodeB = $list->search('b');
        $this->assertNotNull($nodeB);
        $this->assertEquals('b', $nodeB->value);

        $nodeC = $list->search('c');
        $this->assertNotNull($nodeC);
        $this->assertEquals('c', $nodeC->value);
    }

    public function testSearchInt()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::STRING);
        $this->expectException(InvalidTypeException::class);

        $list->search(1);
    }

    public function testSearchNotFound()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::STRING);
        $list->insert('a');
        $list->insert('b');
        $list->insert('c');

        $nodeD = $list->search('d');
        $this->assertNull($nodeD);

        $nodeE = $list->search('e');
        $this->assertNull($nodeE);
    }

    public function testDeleteFromEmptyList()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::STRING);
        $this->assertNull($list->delete('a'));
    }

    public function testDeleteHeadNode()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::STRING);
        $list->insert('a');

        $deletedNode = $list->delete('a');
        $this->assertEquals('a', $deletedNode->value);
        $this->assertNull($list->getHead());

        $list = new TestableSortedLinkList(ListTypeEnum::STRING);
        $list->insert('a');
        $list->insert('b');

        $deletedNode = $list->delete('a');
        $this->assertEquals('a', $deletedNode->value);
        $this->assertEquals('b', $list->getHead()->value);
    }

    public function testDeleteMiddleNode()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::STRING);
        $list->insert('a');
        $list->insert('b');
        $list->insert('c');

        $deletedNode = $list->delete('b');
        $this->assertEquals('b', $deletedNode->value);
        $this->assertEquals('a', $list->getHead()->value);
        $this->assertEquals('c', $list->getHead()->next->value);
    }

    public function testDeleteNonExistentValue()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::STRING);
        $list->insert('a');
        $list->insert('b');
        $list->insert('c');

        $this->assertNull($list->delete('d'));
    }

    public function testDisplayEmptyList()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::STRING);

        ob_start();
        $list->display();
        $output = ob_get_clean();

        $this->assertEquals('', $output);
    }

    public function testDisplayNonEmptyList()
    {
        $list = new TestableSortedLinkList(ListTypeEnum::STRING);
        $list->insert('a');
        $list->insert('c');

        ob_start();
        $list->display();
        $output = ob_get_clean();

        $expectedOutput = "a -> c\n";
        $this->assertEquals($expectedOutput, $output);

        $list = new TestableSortedLinkList(ListTypeEnum::STRING);
        $list->insert('a');
        $list->insert('b');
        $list->insert('c');

        ob_start();
        $list->display();
        $output = ob_get_clean();

        $expectedOutput = "a -> b -> c\n";
        $this->assertEquals($expectedOutput, $output);

        $list->insert('z');
        $list->insert('x');
        $list->insert('y');

        ob_start();
        $list->display();
        $output = ob_get_clean();

        $expectedOutput = "a -> b -> c\nx -> y -> z\n";
        $this->assertEquals($expectedOutput, $output);
    }
}
