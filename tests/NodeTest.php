<?php

namespace falmar\DualSortedLinkList\Tests;

use PHPUnit\Framework\TestCase;

class NodeTest extends TestCase
{
    public function testGetNext()
    {
        $node = new \falmar\DualSortedLinkList\Node(1);
        $this->assertNull($node->getNext());

        $next = new \falmar\DualSortedLinkList\Node(2);
        $node = new \falmar\DualSortedLinkList\Node(1, $next);

        $this->assertInstanceOf(\falmar\DualSortedLinkList\Node::class, $node->getNext());
        $this->assertEquals(2, $node->getNext()->getValue());
    }

    public function testGetValueInt()
    {
        $node = new \falmar\DualSortedLinkList\Node(1);
        $this->assertEquals(1, $node->getValue());

        // causes deprecation warning, but test passes
        // reason: float loses precision when cast to int
        // $node = new \falmar\DualSortedLinkList\Node(1.1);
        // $this->assertEquals(1, $node->getValue());
    }

    public function testGetValueString()
    {
        $node = new \falmar\DualSortedLinkList\Node('1');
        $this->assertEquals('1', $node->getValue());
    }
}
