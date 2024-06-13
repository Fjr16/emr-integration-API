<?php

namespace App\Services\SatuSehat;

use App\Services\SatuSehat\TokenService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class BaseUrlService
{
    protected $tokenService;
    protected $baseUrl;
    protected $tokenAccess;

    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
        $this->baseUrl = env('BASEURL_SATUSEHAT');
        $this->tokenAccess = $this->tokenService->getAccessToken();
    }

    public function getRequest($uri)
    {
        $token = $this->tokenService->getAccessToken();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->baseUrl . $uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token,
        ]);

        /** Nonaktifkan verifikasi SSL - hanya untuk tujuan debugging */
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        /**  Menjalankan sesi cURL */
        $response = curl_exec($ch);

        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($statusCode === 200) {
            return json_decode($response, true);
        } else {
            /** Tangani error sesuai kebutuhan */
            return curl_getinfo($ch);
        }
    }


    public function postRequest($uri, $payload = [])
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->baseUrl . $uri);
        curl_setopt($ch, CURLOPT_POST, 1);

        /** Convert payload to JSON */
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->tokenAccess,
            'Content-Type: application/json',
        ]);

        /** Menonaktifkan verifikasi peer SSL (tidak disarankan di produksi) */
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($statusCode == 200) {
            curl_close($ch);
            return json_decode($response, true);
        } else {
            $error = [
                'statusCode' => $statusCode,
                'response' => $response,
                'info' => curl_getinfo($ch),
            ];
            curl_close($ch);
            return $error;
        }
    }


    public function putRequest($uri, $payload = [])
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->baseUrl . $uri);

        /** Set request method to PUT */
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

        /** Convert payload to JSON */
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->tokenAccess,
            'Content-Type: application/json',
        ]);

        /** Menonaktifkan verifikasi peer SSL (tidak disarankan di produksi) */
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($statusCode == 200) {
            curl_close($ch);
            return json_decode($response, true);
        } else {
            $error = [
                'statusCode' => $statusCode,
                'response' => $response,
                'info' => curl_getinfo($ch),
            ];
            curl_close($ch);
            return $error;
        }
    }


    public function patchRequest($uri, $payload = [])
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->baseUrl . $uri);

        /** Set request method to PATCH */
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');

        /** Convert payload to JSON */
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->tokenAccess,
            'Content-Type: application/json',
        ]);

        /** Menonaktifkan verifikasi peer SSL (tidak disarankan di produksi) */
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($statusCode == 200) {
            curl_close($ch);
            return json_decode($response, true);
        } else {
            $error = [
                'statusCode' => $statusCode,
                'response' => $response,
                'info' => curl_getinfo($ch),
            ];
            curl_close($ch);
            return $error;
        }
    }
}