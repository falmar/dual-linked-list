<?php
use falmar\DualSortedLinkList\SortedLinkListProvider;
use falmar\DualSortedLinkList\Enums\ListTypeEnum;
use falmar\DualSortedLinkList\Node;

include_once __DIR__ . '/../vendor/autoload.php';

// Use the provider to create a sorted link list given an enum type.
$provider = new SortedLinkListProvider();
$list = $provider->makeList(ListTypeEnum::INTEGER);

$list->insert(2);
$list->insert(1);
$list->insert(3);

/** @var Node|null $node returns node if found */
$node = $list->search(2);
echo $node->value; // output: 2

$list->delete(2); // returns the deleted node if any

$list->display(); // output: "1 -> 3"
