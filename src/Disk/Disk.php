<?php

namespace HamZone\AuthPhone\Disk;

use Illuminate\Contracts\Filesystem\Cloud;

class Disk 
{
    public function __construct(public Cloud $Storage) {
    }

    public function storeSet(string $set)
    {
        $path = "aes-key.txt";
        $this->Storage->put($path, $set);
    }

}