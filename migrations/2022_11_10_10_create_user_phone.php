<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        if ($schema->hasTable('user_phone')) {
            return;
        }

        $schema->create('user_phone', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->index();
            $table->string('phone');
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
        });
    },
    'down' => function (Builder $schema) {
        
    },
];