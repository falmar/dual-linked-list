<?php

namespace falmar\DualSortedLinkList\Enums;

enum ListTypeEnum
{
    case INTEGER;
    case STRING;

    // for sake of implementation correctness
    case UNKNOWN;
}
