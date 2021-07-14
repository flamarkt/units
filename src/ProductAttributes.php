<?php

namespace Flamarkt\Units;

use Flamarkt\Core\Api\Serializer\ProductSerializer;
use Flamarkt\Core\Product\Product;

class ProductAttributes
{
    public function __invoke(ProductSerializer $serializer, Product $product): array
    {
        $attributes = [
            'unit' => $product->unit,
            // TODO: value inheritance from unit
            'amountMin' => $product->amount_min,
            'amountMax' => $product->amount_max,
            'amountStep' => $product->amount_step,
        ];

        if ($serializer->getActor()->can('backoffice')) {
            $attributes += [
                'amountMinEdit' => $product->amount_min,
                'amountMaxEdit' => $product->amount_max,
                'amountStepEdit' => $product->amount_step,
            ];
        }

        return $attributes;
    }
}
