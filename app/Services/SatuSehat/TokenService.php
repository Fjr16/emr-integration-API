<?php

namespace App\Services\SatuSehat;

use Illuminate\Support\Facades\Cache;

class TokenService
{
    public function getAccessToken()
    {
        $authUrl = env('AUTHURL_SATUSEHAT');
        $clientId = env('CLIENTID_SATUSEHAT');
        $clientSecret = env('CLIENTSECRET_SATUSEHAT');

        $postData = [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $authUrl . '/accesstoken?grant_type=client_credentials');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Menonaktifkan verifikasi peer SSL (tidak disarankan di produksi)
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // Menonaktifkan verifikasi host SSL (tidak disarankan di produksi)

        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($statusCode == 200) {
            $data = json_decode($response, true);
            $token = $data['access_token'];

            /** Simpan token di cache selama masa berlakunya */
            Cache::put('access_token', $token, $data['expires_in']);

            return $token;
        } else {
            /** penanganan error */
            return null;
        }
    }
    
}