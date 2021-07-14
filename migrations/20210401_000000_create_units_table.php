<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->create('flamarkt_units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('preset')->nullable();
            $table->string('label_singular')->nullable();
            $table->string('label_plural')->nullable();
            $table->unsignedTinyInteger('decimals')->default(0);
            $table->unsignedInteger('default_min')->nullable();
            $table->unsignedInteger('default_max')->nullable();
            $table->unsignedInteger('default_step')->nullable();
        });
    },
    'down' => function (Builder $schema) {
        $schema->dropIfExists('flamarkt_units');
    },
];
