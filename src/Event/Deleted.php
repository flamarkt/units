<?php

namespace Flamarkt\Units\Event;

use Flamarkt\Units\Unit;
use Flarum\User\User;

class Deleted
{
    public $unit;
    public $actor;

    public function __construct(Unit $unit, User $actor)
    {
        $this->unit = $unit;
        $this->actor = $actor;
    }
}
