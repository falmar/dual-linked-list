<?php

namespace falmar\DualSortedLinkList;

use falmar\DualSortedLinkList\Exceptions\InvalidTypeException;

interface SortedLinkListInterface
{
    /**
     * Insert a value into the sorted link list.
     * @param string|int $value
     * @throws InvalidTypeException
     */
    public function insert(string|int $value): Node;

    /**
     * Search for a value in the sorted link list and return the node.
     * @param string|int $value
     * @return Node|null
     */
    public function search(string|int $value): ?Node;

    /**
     * Delete a value from the sorted link list and return the node that was deleted.
     * @param string|int $value
     * @return Node|null
     */
    public function delete(string|int $value): ?Node;

    /**
     * Display the sorted link list.
     * @return void
     */
    public function display(): void;
}
