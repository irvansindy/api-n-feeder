<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class NeoFeederJsonService
{
    protected string $baseUrl = 'https://neofeeder.serveruis.my.id/ws/live2.php';

    public function getToken(string $username, string $password)
    {
        $payload = [
            'act' => 'GetToken',
            'username' => $username,
            'password' => $password,
        ];

        return $this->send($payload);
    }

    public function getOrCacheToken(string $username, string $password)
    {
        // Cache key berdasarkan username (aman untuk multi-user)
        $cacheKey = 'feeder_token_' . md5($username);

        return Cache::remember($cacheKey, now()->addHours(3), function () use ($username, $password) {
            $response = $this->getToken($username, $password);

            if (!empty($response['error_code'])) {
                throw new \Exception("Gagal mendapatkan token: " . $response['error_desc']);
            }

            return $response['data']['token'];
        });
    }

    public function refreshToken(string $username, string $password)
    {
        Cache::forget('neofeeder_token');
        $token = $this->getToken($username, $password);
        Cache::put('neofeeder_token', $token, now()->addHours(3));
        return $token;
    }


    public function getListMahasiswa(string $token, string $filter = '', int $limit = 10, int $offset = 0)
    {
        $payload = [
            'act' => 'GetListMahasiswa',
            'token' => $token,
            'filter' => $filter,
            'limit' => $limit,
            'offset' => $offset,
        ];

        return $this->send($payload);
    }

    // NeoFeederJsonService.php

    public function insertBiodataMahasiswa(array $record)
    {
        $username = config('services.neofeeder.username');
        $password = config('services.neofeeder.password');

        $token = $this->getOrCacheToken($username, $password);

        $payload = [
            'act' => 'InsertBiodataMahasiswa',
            'token' => $token,
            'record' => $record,
        ];

        $response = $this->send($payload);

        if (isset($response['error_code']) && $response['error_code'] === 'ERROR_AUTH') {
            $token = $this->refreshToken($username, $password);
            $payload['token'] = $token;
            $response = $this->send($payload);
        }

        return $response;
    }

    public function updateBiodataMahasiswa(array $record)
    {
        $username = config('services.neofeeder.username');
        $password = config('services.neofeeder.password');

        $token = $this->getOrCacheToken($username, $password);

        $payload = [
            'act' => 'UpdateBiodataMahasiswa',
            'token' => $token,
            'record' => $record,
        ];

        $response = $this->send($payload);

        // Jika token expired, refresh dan coba lagi (pesimistik logic)
        if (isset($response['error_code']) && $response['error_code'] === 'ERROR_AUTH') {
            $token = $this->refreshToken($username, $password);
            $payload['token'] = $token;
            $response = $this->send($payload);
        }

        return $response;
    }

    public function deleteBiodataMahasiswa(string $id_mahasiswa)
    {
        $username = config('services.neofeeder.username');
        $password = config('services.neofeeder.password');

        $token = $this->getOrCacheToken($username, $password);

        $payload = [
            'act' => 'DeleteBiodataMahasiswa',
            'token' => $token,
            'key' => $id_mahasiswa,
        ];

        $response = $this->send($payload);

        // Pesimistik logic: jika token expired atau invalid
        if (isset($response['error_code']) && $response['error_code'] === 'ERROR_AUTH') {
            $token = $this->refreshToken($username, $password);
            $payload['token'] = $token;
            $response = $this->send($payload);
        }

        return $response;
    }


    public function send(array $payload)
    {
        try {
            $response = Http::withoutVerifying() // jika sertifikat SSL invalid
                ->timeout(10)
                ->post($this->baseUrl, $payload);

            return $response->json();
        } catch (\Throwable $e) {
            return [
                'error_code' => 'REQUEST_ERROR',
                'error_desc' => $e->getMessage(),
            ];
        }
    }

    // ==============
    public function GetProdi(string $filter = '', int $limit = 10, int $offset = 0)
    {
        $username = config('services.neofeeder.username');
        $password = config('services.neofeeder.password');

        $token = $this->getOrCacheToken($username, $password);

        $payload = [
            'act' => 'GetProdi',
            'token' => $token,
            'filter' => $filter,
            'limit' => $limit,
            'offset' => $offset,
        ];

        return $this->send($payload);
    }

    public function GetListMataKuliah(string $filter = '', int $limit = 10, int $offset = 0)
    {
        $username = config('services.neofeeder.username');
        $password = config('services.neofeeder.password');

        $token = $this->getOrCacheToken($username, $password);

        $payload = [
            'act' => 'GetListMataKuliah',
            'token' => $token,
            'filter' => $filter,
            'limit' => $limit,
            'offset' => $offset,
        ];

        return $this->send($payload);
    }

    public function GetDetailMataKuliah(string $filter = '', int $limit = 10, int $offset = 0)
    {
        $username = config('services.neofeeder.username');
        $password = config('services.neofeeder.password');

        $token = $this->getOrCacheToken($username, $password);

        $payload = [
            'act' => 'GetDetailMataKuliah',
            'token' => $token,
            'filter' => $filter,
            'limit' => $limit,
            'offset' => $offset,
        ];

        return $this->send($payload);
    }

    public function InsertMataKuliah(array $record)
    {
        $username = config('services.neofeeder.username');
        $password = config('services.neofeeder.password');

        $token = $this->getOrCacheToken($username, $password);

        $payload = [
            'act' => 'InsertMataKuliah',
            'token' => $token,
            'record' => $record,
        ];

        $response = $this->send($payload);

        if (isset($response['error_code']) && $response['error_code'] === 'ERROR_AUTH') {
            $token = $this->refreshToken($username, $password);
            $payload['token'] = $token;
            $response = $this->send($payload);
        }

        return $response;
    }
    
    public function UpdateMataKuliah(string $key, array $record)
    {
        $username = config('services.neofeeder.username');
        $password = config('services.neofeeder.password');

        $token = $this->getOrCacheToken($username, $password);

        $payload = [
            'act' => 'UpdateMataKuliah',
            'token' => $token,
            'key' => [
                'id_matkul' => $key
            ],
            'record' => $record,
        ];

        $response = $this->send($payload);

        if (isset($response['error_code']) && $response['error_code'] === 'ERROR_AUTH') {
            $token = $this->refreshToken($username, $password);
            $payload['token'] = $token;
            $response = $this->send($payload);
        }

        return $response;
    }

    public function DeleteMataKuliah(string $key)
    {
        $username = config('services.neofeeder.username');
        $password = config('services.neofeeder.password');

        $token = $this->getOrCacheToken($username, $password);

        $payload = [
            'act' => 'DeleteMataKuliah',
            'token' => $token,
            'key' => [
                'id_matkul' => $key
            ],
        ];

        $response = $this->send($payload);

        if (isset($response['error_code']) && $response['error_code'] === 'ERROR_AUTH') {
            $token = $this->refreshToken($username, $password);
            $payload['token'] = $token;
            $response = $this->send($payload);
        }

        return $response;
    }
}
