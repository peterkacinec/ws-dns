<?php

namespace app\services;

class WsService
{
    const BASE_PATH = '/v1/user/' . USER_ID . '/zone/' . DOMAIN_NAME . '/record';
    private $method;
    private $path;
    private $response;

    public function config($data)
    {
        $time = time();
        $canonicalRequest = sprintf('%s %s %s', $this->method, $this->path, $time);
        $signature = hash_hmac('sha1', $canonicalRequest, SECRET);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, sprintf('%s%s', API, $this->path));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, API_KEY.':'.$signature);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Date: ' . gmdate('Ymd\THis\Z', $time),
            'Content-Type: application/json',
            'Accept: application/json'
        ]);

        if ($this->method === 'POST') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        if($this->method == 'DELETE') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->method);
        }

        if($this->method == 'PUT') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->method);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        $this->response = json_decode($response, true);
        curl_close($ch);
    }

    public function makeRequest($method, string $path = '', ?array $data = null)
    {
        $this->path = self::BASE_PATH . $path;
        $this->method = $method;

        $this->config($data);

        return $this->response;
    }
}