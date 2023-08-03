<?php

namespace falmar\DualSortedLinkList\Tests;

use PHPUnit\Framework\TestCase;

class NodeTest extends TestCase
{
    public function testGetNext()
    {
        $node = new \falmar\DualSortedLinkList\Node(1);
        $this->assertNull($node->next);

        $next = new \falmar\DualSortedLinkList\Node(2);
        $node = new \falmar\DualSortedLinkList\Node(1, $next);

        $this->assertInstanceOf(\falmar\DualSortedLinkList\Node::class, $node->next);
        $this->assertEquals(2, $node->next->value);
    }

    public function testGetValueInt()
    {
        $node = new \falmar\DualSortedLinkList\Node(1);
        $this->assertEquals(1, $node->value);

        // causes deprecation warning, but test passes
        // reason: float loses precision when cast to int
        // $node = new \falmar\DualSortedLinkList\Node(1.1);
        // $this->assertEquals(1, $node->getValue());
    }

    public function testGetValueString()
    {
        $node = new \falmar\DualSortedLinkList\Node('1');
        $this->assertEquals('1', $node->value);
    }
}
