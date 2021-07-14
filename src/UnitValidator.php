<?php

namespace Flamarkt\Units;

use Flarum\Foundation\AbstractValidator;

class UnitValidator extends AbstractValidator
{
    /**
     * @var Unit|null
     */
    protected $unit;

    public function setUnit(Unit $unit)
    {
        $this->unit = $unit;
    }

    protected function getRules(): array
    {
        $idSuffix = $this->unit ? ',' . $this->unit->id : '';

        return [
            'slug' => [
                'required',
                'regex:/^[a-z0-9_-]+$/i',
                'unique:flamarkt_units,slug' . $idSuffix,
                'min:1',
                'max:30',
            ],
        ];
    }
}
