<?php

//function base_url($url='') {
//    return url($url);
//}

function print_me($data, $die=false){
    print "<pre>";
    print_r($data);
    print "</pre>";
    if ($die)
        die();
}

function error_response($request, $error)
{
    if($request->ajax())
        return response(['errors'=>$error, 'message'=>'The given data is invalid.'], 422);
    else
        return redirect()->back()->withErrors($error);
}

function success_response($request, $message, $url)
{
    if($request->ajax())
        return response(['message'=>$message, 'url'=>$url]);
    else
        return redirect($url);
}

function decryptData($string, $salt)
{
    $password = "yEfHZ18ly"; //$this->objDefaultVariable->VAR_PASSWORD_CRYPTO_KEY;

    $encrypt_method = "AES-256-CBC";
    $secret_key = $password;
    $secret_iv = $salt;

    $secret_iv_first = strrev(substr($secret_iv, 0, 5));
    $secret_iv_last = strrev(substr($secret_iv, -5));
    $secret_iv = $secret_iv_last . '9' . $secret_iv_first;

    // hash
    $key = hash('sha256', $secret_key);
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    return openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
}

function encryptData($plaintext): array
{
    $password = "yEfHZ18ly"; //$this->objDefaultVariable->VAR_PASSWORD_CRYPTO_KEY;
    //$password = $this->objDefaultVariable->VAR_PASSWORD_CRYPTO_KEY;

    $rand_IV = date('His', time()) . mt_rand();
    $rand_IV = str_shuffle($rand_IV);



    $encrypt_method = "AES-256-CBC";
    $secret_key = $password;

    $secret_iv = $rand_IV;
    $secret_iv_first = strrev(substr($secret_iv, 0, 5));
    $secret_iv_last = strrev(substr($secret_iv, -5));
    $secret_iv = $secret_iv_last . '9' . $secret_iv_first;
    // hash
    $key = hash('sha256', $secret_key);
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    $output = openssl_encrypt($plaintext, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($output);
    $d["enc_text"] = $output;
    $d["salt"] = $rand_IV;
    return $d;
}

function remove_special_characters($dirty_string){
    $clean_string = str_replace(' ', '-', $dirty_string);
    $clean_string = preg_replace('/[^A-Za-z0-9\-]/', '', $clean_string);
    return preg_replace('/-+/', '-', $clean_string);
}

