<?php 
namespace App\Helper;

use Exception;
use Illuminate\Support\Facades\Crypt;

class EncryptionHelper
{
    public static function encrypt($id)
    {
        $encryptedData = Crypt::encryptString($id);
        $encryptedBase64 = base64_encode($encryptedData);

        return $encryptedBase64;
    }

    public static function decrypt($id)
    {
        $encryptedData = base64_decode($id);
        $decryptedData = Crypt::decryptString($encryptedData);

        return $decryptedData;
    }

    // Inacbg encrypt decrypt
    public static function inacbgEncrypt($plaintext, $key){
        $key = hex2bin($key);

        if (mb_strlen($key, "8bit") !== 32) {
            throw new Exception("Needs a 256-bit key!");
         }
           /// create initialization vector
        $iv_length = openssl_cipher_iv_length('aes-256-cbc');
        $iv = random_bytes($iv_length); // dengan catatan dibawah

        // Encrypt plaintext
        $ciphertext = openssl_encrypt($plaintext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);

        // $signature = mb_substr(hash_hmac("sha256", $ciphertext, $key, true), 0); 
        $signature = mb_substr(hash_hmac("sha256", $ciphertext, $key, true), 0, 10, "8bit"); 

        // combine all, encode, and format
        $encrypted = chunk_split(base64_encode($signature.$iv.$ciphertext));
        
        return $encrypted;
    }

    public static function inacbgDecrypt($encrypted, $key){
        $key = hex2bin($key);

        if (mb_strlen($key, "8bit") !== 32) {
            throw new Exception("Needs a 256-bit key!");
        }

        // Get IV length
        $iv_length = openssl_cipher_iv_length('aes-256-cbc');

        // Decode base64 encoded string
        $decoded = base64_decode($encrypted);
        
        // Extract IV and ciphertext and signature
        $iv = mb_substr($decoded, 10, $iv_length, '8bit');
        $signature = mb_substr($decoded, 0, 10, '8bit');
        $ciphertext = mb_substr($decoded, $iv_length+10, NULL, '8bit');

        $calc_signature = mb_substr(hash_hmac('sha256', $ciphertext, $key, true), 0, 10, '8bit');
        
        // echo 'signature' . $signature;
        // echo 'calc_signature' . $calc_signature;
        if(!hash_equals($signature, $calc_signature)){
            return 'SIGNATURE_NOT_MATCH';
        }

        // Decrypt ciphertext
        $plaintext = openssl_decrypt($ciphertext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        
        return $plaintext;
    }

    // private static function inacbgCompare($a, $b){
    //     // compare individually to prevent timing attacks
    //     /// compare length
    //     if (strlen($a) !== strlen($b)) return false;
    //     /// compare individual
    //     $result = 0;
    //     for($i = 0; $i < strlen($a); $i ++) {
    //         $result |= ord($a[$i]) ^ ord($b[$i]);
    //     }
    //     return $result == 0;
    // }

    // public static function encrypt_AES_CBC($plaintext, $key) {
    //     $key = hex2bin($key);

    //     if (mb_strlen($key, "8bit") !== 32) {
    //         throw new Exception("Needs a 256-bit key!");
    //      }
    //        /// create initialization vector
    //     $iv_length = openssl_cipher_iv_length('aes-256-cbc');
    //     $iv = random_bytes($iv_length); // dengan catatan dibawah

    //     // Encrypt plaintext
    //     $ciphertext = openssl_encrypt($plaintext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);

    //     // $signature = mb_substr(hash_hmac("sha256", $ciphertext, $key, true), 0); 
    //     $signature = mb_substr(hash_hmac("sha256", $ciphertext, $key, true), 0, 10, "8bit"); 

    //     // combine all, encode, and format
    //     $encrypted = chunk_split(base64_encode($signature.$iv.$ciphertext));
        
    //     return $encrypted;
    // }

    // public static function decrypt_AES_CBC($encrypted, $key) {
    //     $key = hex2bin($key);

    //     if (mb_strlen($key, "8bit") !== 32) {
    //         throw new Exception("Needs a 256-bit key!");
    //     }

    //     // Get IV length
    //     $iv_length = openssl_cipher_iv_length('aes-256-cbc');

    //     // Decode base64 encoded string
    //     $decoded = base64_decode($encrypted);
        
    //     // Extract IV and ciphertext and signature
    //     $iv = mb_substr($decoded, 10, $iv_length, '8bit');
    //     $signature = mb_substr($decoded, 0, 10, '8bit');
    //     $ciphertext = mb_substr($decoded, $iv_length+10, NULL, '8bit');

    //     $calc_signature = mb_substr(hash_hmac('sha256', $ciphertext, $key, true), 0, 10, '8bit');
        
    //     // echo 'signature' . $signature;
    //     // echo 'calc_signature' . $calc_signature;
    //     if(!hash_equals($signature, $calc_signature)){
    //         return 'SIGNATURE_NOT_MATCH';
    //     }

    //     // Decrypt ciphertext
    //     $plaintext = openssl_decrypt($ciphertext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        
    //     return $plaintext;
    // }
}
 ?>