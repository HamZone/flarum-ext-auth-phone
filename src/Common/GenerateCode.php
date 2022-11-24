<?php
namespace HamZone\AuthPhone\Common;

use Illuminate\Contracts\Cache\Repository;

class GenerateCode 
{

    protected $cache;

    public function __construct(Repository $cache)
    {
        $this->cache = $cache;
    }

    public function generate($phone){
        $randNumber = mt_rand(100000,999999);
        str_shuffle($randNumber);

        $status = $this->cache->get($phone);
        if($status){
            app('log')->info( "key exist continue ".$phone." ".$status );
            return 1;
        }

        $this->cache->put($phone, $randNumber, 300);
        return $randNumber;
    }
}