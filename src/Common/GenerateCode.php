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

    public function generate($uid, $phone, $second){
        $randNumber = mt_rand(100000,999999);
        str_shuffle($randNumber);

        $status = $this->cache->get($uid."_".$phone);
        if($status){
            app('log')->info( "key exist continue ".$phone." ".$status );
            return array((int)$this->cache->get($phone."_time"), true);
        }
        if(!$second || $second==0){
            $second = 300;
        }
        $this->cache->put($uid."_".$phone, $randNumber, $second);
        $this->cache->put($phone."_time", time() + $second, $second);

        return array($randNumber,false);
    }
}