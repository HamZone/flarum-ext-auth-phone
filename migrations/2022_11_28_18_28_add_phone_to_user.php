<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        if (!$schema->hasColumn('users', 'phone')) {
            $schema->table('users', function (Blueprint $table) use ($schema) {
                $table->string('phone', 254)->nullable();
            });
        }
    },
    'down' => function (Builder $schema) {
        
    },
];