<?php

namespace Flamarkt\Units;

use Flamarkt\Core\Api\Serializer\ProductSerializer;
use Flamarkt\Core\Product\Event\Saving;
use Flamarkt\Core\Product\Product;
use Flamarkt\Core\Product\ProductFilterer;
use Flarum\Extend;

return [
    (new Extend\Frontend('backoffice'))
        ->js(__DIR__ . '/js/dist/backoffice.js')
        ->route('/units', 'units.index')
        ->route('/units/{id:[0-9a-f-]+|new}', 'units.show'),

    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js'),

    new Extend\Locales(__DIR__ . '/resources/locale'),

    (new Extend\Routes('api'))
        ->get('/flamarkt/units', 'flamarkt.units.index', Api\Controller\UnitIndexController::class)
        ->post('/flamarkt/units', 'flamarkt.units.store', Api\Controller\UnitStoreController::class)
        ->get('/flamarkt/units/{id:[0-9a-f-]+}', 'flamarkt.units.show', Api\Controller\UnitShowController::class)
        ->patch('/flamarkt/units/{id:[0-9a-f-]+}', 'flamarkt.units.update', Api\Controller\UnitUpdateController::class)
        ->delete('/flamarkt/units/{id:[0-9a-f-]+}', 'flamarkt.units.delete', Api\Controller\UnitDeleteController::class),

    (new Extend\ApiSerializer(ProductSerializer::class))
        ->attributes(ProductAttributes::class),

    (new Extend\Event())
        ->listen(Saving::class, Listener\SavingProduct::class),

    (new Extend\Filter(UnitFilterer::class))
        ->addFilter(Filter\PresetFilter::class),
];
