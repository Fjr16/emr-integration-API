<?php

namespace App\Services\SatuSehat;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class TokenService
{
    public function getAccessToken()
    {
        $clientPass = env('CLIENT_PASSWORD');
        $clientEmail = env('CLIENT_USERNAME');
        $clientId = env('CLIENTID_SATUSEHAT');

        $postData = [
            'client_id' => $clientId,
            'email' => $clientEmail,
            'password' => $clientPass
        ];

        $response = Http::post($postData);

        if ($response->getStatusCode() == 200) {
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