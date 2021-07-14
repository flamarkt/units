<?php

namespace Flamarkt\Units\Api\Serializer;

use Flamarkt\Units\Unit;
use Flarum\Api\Serializer\AbstractSerializer;

class UnitSerializer extends AbstractSerializer
{
    protected $type = 'flamarkt-units';

    /**
     * @param Unit $unit
     * @return array
     */
    protected function getDefaultAttributes($unit): array
    {
        $attributes = [
            'slug' => $unit->slug,
            'preset' => $unit->preset,
            'labelSingular' => $unit->label_singular,
            'labelPlural' => $unit->label_plural,
            'decimals' => $unit->decimals,
        ];

        if ($this->actor->can('backoffice')) {
            $attributes += [
                'defaultMin' => $unit->default_min,
                'defaultMax' => $unit->default_max,
                'defaultStep' => $unit->default_step,
            ];
        }

        return $attributes;
    }
}
