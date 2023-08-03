# Dual Sorted Linked List

This package provides a sorted linked list implementation, allowing you to insert, search, delete, and display values in
a sorted order. The values can be either integers or strings but not both.

## Installation

You can install the package via composer:

```bash
$ composer require falmar/dual-linked-list
```

## Usage

When the provider is not used, the sorted link list can be instantiated directly. the type of value can be either string or integer and will be defined as soon the first value is added, however I prefer to use a ServiceProvider style class to create the sorted link list instead.

The provided interface:

```php
<?php
// ./src/SortedLinkListInterface.php
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

```

## Examples

```php
<?php
// ./examples/basic.php
use falmar\DualSortedLinkList\SortedLinkListProvider;
use falmar\DualSortedLinkList\Enums\ListTypeEnum;
use \falmar\DualSortedLinkList\Enums\OrderEnum;
use falmar\DualSortedLinkList\Node;

include_once __DIR__ . '/../vendor/autoload.php';

// Use the provider to create a sorted link list given an enum type and order 
$provider = new SortedLinkListProvider();
$list = $provider->makeList(ListTypeEnum::INTEGER, OrderEnum::ASCENDING);

$list->insert(2);
$list->insert(1);
$list->insert(3);

/** @var Node|null $node returns node if found */
$node = $list->search(2);
echo $node->value; // output: 2

$list->delete(2); // returns the deleted node if any

$list->display(); // output: "1 -> 3"
```

## Testing


### Local
Assuming PHP 8.2, composer, and xdebug module are installed. You can run the PHPUnit tests with the following command:

```bash
$ composer test
```

### Docker

PHP 8.2 + PHPUnit docker image at https://hub.docker.com/r/jitesoft/phpunit

```bash
$ docker run --rm -it -v $PWD:/php-app --user 1000 jitesoft/phpunit sh
$ cd /php-app
$ composer install
$ composer test
```

## License

MIT License
