<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->table('flamarkt_products', function (Blueprint $table) {
            $table->string('unit')->nullable();
            $table->unsignedInteger('amount_min')->nullable();
            $table->unsignedInteger('amount_max')->nullable();
            $table->unsignedInteger('amount_step')->nullable();
        });
    },
    'down' => function (Builder $schema) {
        $schema->table('flamarkt_products', function (Blueprint $table) {
            $table->dropColumn('unit');
            $table->dropColumn('amount_min');
            $table->dropColumn('amount_max');
            $table->dropColumn('amount_step');
        });
    },
];
