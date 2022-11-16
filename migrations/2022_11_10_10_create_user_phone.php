<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        if ($schema->hasTable('user_phone')) {
            return;
        }

        $schema->create('user_phone', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->string('phone');
            $table->timestamp('updated_at')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    },
    'down' => function (Builder $schema) {
        
    },
];