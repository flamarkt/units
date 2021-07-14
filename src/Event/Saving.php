<?php

namespace Flamarkt\Units\Event;

use Flamarkt\Units\Unit;
use Flarum\User\User;

class Saving
{
    public $unit;
    public $actor;
    public $data;

    public function __construct(Unit $unit, User $actor, array $data = [])
    {
        $this->unit = $unit;
        $this->actor = $actor;
        $this->data = $data;
    }
}
