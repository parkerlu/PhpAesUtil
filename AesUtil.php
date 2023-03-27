<?php
namespace App\Support;
class AesUtil{

    public $method;//加密算法
    public $secret_key;//密钥

    public function __construct($password){
        $this->method = 'AES-128-ECB';//定义AES加密算法
        $this->secret_key = substr(openssl_digest(openssl_digest($password, 'sha1', true), 'sha1', true), 0, 16);
    }

    public  function encrypt($string): string
    {
        // 对接java，服务商做的AES加密通过SHA1PRNG算法（只要password一样，每次生成的数组都是一样的），Java的加密源码翻译php如下：
        $key = $this->secret_key;
        // openssl_encrypt 加密不同Mcrypt，对秘钥长度要求，超出16加密结果不变
        $data = openssl_encrypt($string, $this->method, $key, OPENSSL_RAW_DATA);
        return strtolower(bin2hex($data));
    }

    public function decrypt($string)
    {
        $key = $this->secret_key;
        // 对接java，服务商做的AES加密通过SHA1PRNG算法（只要password一样，每次生成的数组都是一样的），Java的加密源码翻译php如下：
        return openssl_decrypt(hex2bin($string), $this->method, $key, OPENSSL_RAW_DATA);
    }
}
