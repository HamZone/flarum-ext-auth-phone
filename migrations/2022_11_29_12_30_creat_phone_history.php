<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        if ($schema->hasTable('phone_history')) {
            return;
        }

        $schema->create('phone_history', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->index();
            $table->string('phone')->nullable();
        });
    },
    'down' => function (Builder $schema) {
        
    },
];