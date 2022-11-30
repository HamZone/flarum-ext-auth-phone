<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

//新增 users 表字段 phone
return [
    'up' => function (Builder $schema) {
        if (!$schema->hasColumn('users', 'phone')) {
            $schema->table('users', function (Blueprint $table) use ($schema) {
                $table->string('phone', 254)->default('');
            });
        }
    },
    'down' => function (Builder $schema) {
        
    },
];