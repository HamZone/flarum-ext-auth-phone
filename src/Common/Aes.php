<?php
namespace HamZone\AuthPhone\Common;
class Aes 
{
    protected $key;//32
    protected $iv;//16 

    function __construct($key,$iv) {
        $this->key = $key;
        $this->iv = $iv;
    }

    function Encrypt(string $text)
    {
        return base64_encode(openssl_encrypt($text, 'AES-256-CBC', $this->key, OPENSSL_RAW_DATA, $this->iv));
    }


    function Decrypt(string $text)
    {
        return openssl_encrypt(base64_decode($text), 'AES-256-CBC', $this->key, OPENSSL_RAW_DATA, $this->iv);
    }

}