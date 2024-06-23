<?php 
namespace App\Helper;

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
}
 ?>