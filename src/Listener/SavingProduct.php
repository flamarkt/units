<?php

namespace Flamarkt\Units\Listener;

use Flamarkt\Core\Product\Event\Saving;
use Illuminate\Support\Arr;

class SavingProduct
{
    public function handle(Saving $event)
    {
        $attributes = (array)Arr::get($event->data, 'attributes');

        if (Arr::exists($attributes, 'unit')) {
            $event->actor->assertCan('backoffice');

            $event->product->unit = Arr::get($attributes, 'unit');
        }

        if (Arr::exists($attributes, 'amountMin')) {
            $event->actor->assertCan('backoffice');

            $event->product->amount_min = Arr::get($attributes, 'amountMin');
        }

        if (Arr::exists($attributes, 'amountMax')) {
            $event->actor->assertCan('backoffice');

            $event->product->amount_max = Arr::get($attributes, 'amountMax');
        }

        if (Arr::exists($attributes, 'amountStep')) {
            $event->actor->assertCan('backoffice');

            $event->product->amount_step = Arr::get($attributes, 'amountStep');
        }
    }
}
