<?php

namespace HamZone\AuthPhone;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Support\Str;

class KeyDisk
{
    protected $dir;
    protected $filename;

    public function __construct(Factory $filesystemFactory)
    {
        $this->dir = $filesystemFactory->disk('flarum-aes');
        $this->filename = "aesKey";
    }

    public function store(){
        $key = str_replace("-","",Str::uuid());
        $iv = Str::random(16);
        $this->dir->put($this->filename, json_encode(
            [
                "key"=>$key,
                "iv"=>$iv,
                "desc"=>"flarum phone aes encrypt"
            ],true)
        );
    }

    public function exists(){
        return $this->dir->exists($this->filename);
    }

    public function get(): array{
        return json_decode($this->dir->get($this->filename),true);
    }

}