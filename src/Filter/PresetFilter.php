<?php

namespace Flamarkt\Units\Filter;

use Flarum\Filter\FilterInterface;
use Flarum\Filter\FilterState;

class PresetFilter implements FilterInterface
{
    public function getFilterKey(): string
    {
        return 'preset';
    }

    public function filter(FilterState $filterState, string $filterValue, bool $negate)
    {
        $filterState->getQuery()->where('flamarkt_units.preset', $negate ? '!=' : '=', $filterValue);
    }
}
