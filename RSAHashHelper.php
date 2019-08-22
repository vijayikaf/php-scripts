<?php
namespace App\Http\Helpers;

class RSAHashHelper{
    
    #Reference url: https://gist.github.com/veny/6c72c7bf89fd464b28c7512d2c472a5e#file-gistfile1-txt-L3

    /**
     * Encrypt the given value.
     *
     * @param  string  $value
     * @return string  $privKeyBasePath
     * @return string
     */
    public static function encrypt($value, $privKeyBasePath = '') {
        if($privKeyBasePath){
            $privKey = openssl_pkey_get_private('file://'.$privKeyBasePath);
        }else{
            $privKey = openssl_pkey_get_private('file://'.base_path().'/private.pem');
        }
        
        $encryptedValue = "";
        if($privKey != false){
            openssl_private_encrypt($value, $encryptedValue, $privKey);
        }
        return $encryptedValue;
    }

    /**
     * Decrypt the given value.
     *
     * @param  string  $value
     * @param  string  $pubKeyBasePath
     * @return string
     */
    public static function decrypt($encryptedValue, $pubKeyBasePath = '') {
        if($pubKeyBasePath){
            $pubKey = openssl_pkey_get_public('file://'.$pubKeyBasePath);
        }else{
            $pubKey = openssl_pkey_get_public('file://'.base_path().'/public.pem');
        }
        
        $decryptedValue = "";
        if($pubKey != false){
            openssl_public_decrypt($encryptedValue, $decryptedValue, $pubKey);
        }
        return $decryptedValue;
    }
}