<?php

namespace Flamarkt\Units;

use Flarum\Database\AbstractModel;
use Flarum\Database\ScopeVisibilityTrait;
use Flarum\Foundation\EventGeneratorTrait;

/**
 * @property int $id
 * @property string $slug
 * @property string $preset
 * @property string $label_singular
 * @property string $label_plural
 * @property int $decimals
 * @property int $default_min
 * @property int $default_max
 * @property int $default_step
 */
class Unit extends AbstractModel
{
    use EventGeneratorTrait;
    use ScopeVisibilityTrait;

    protected $table = 'flamarkt_units';
}
