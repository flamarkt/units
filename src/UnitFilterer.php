<?php

namespace Flamarkt\Units;

use Flarum\Filter\AbstractFilterer;
use Flarum\User\User;
use Illuminate\Database\Eloquent\Builder;

class UnitFilterer extends AbstractFilterer
{
    protected function getQuery(User $actor): Builder
    {
        return Unit::whereVisibleTo($actor);
    }
}
