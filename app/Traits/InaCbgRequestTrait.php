<?php
namespace App\Traits;

use App\Helper\EncryptionHelper;

trait InaCbgRequestTrait
{
    public function makeRequestToInacbg($data) {
        $key = env('KEY_INA');

        // Enkripsi payload
        $payload = EncryptionHelper::inacbgEncrypt($data, $key);
        
        // Konfigurasi dan eksekusi permintaan HTTP
        $header = array("Content-Type: application/x-www-form-urlencoded");
        $url = '192.168.54.232/E-Klaim/ws.php';

        // etup curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        $response = curl_exec($ch);

        $first  = strpos($response, "\n")+1;
        $last   = strrpos($response, "\n")-1;
        $response  = substr($response, $first, strlen($response) - $first - $last);

        // decrypt dengan fungsi inacbg_decrypt
        $response = EncryptionHelper::inacbgDecrypt($response, $key);
        
        // hasil decrypt adalah format json, ditranslate kedalam array
        $msg = json_decode($response, true);
        return $msg;
    }
}
