<?php
class ApiClient
{
    private $baseUrl;
    private $headers;

    public function __construct($baseUrl, $headers = [])
    {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->headers = $headers;
    }

    private function request($method, $endpoint, $data = null, $isMultipart = false)
    {
        $url = $this->baseUrl . '/' . ltrim($endpoint, '/');
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        if ($this->headers) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        }

        if ($data) {
            if ($isMultipart) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            } else {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                if (!in_array('Content-Type: application/json', $this->headers)) {
                    $this->headers[] = 'Content-Type: application/json';
                }
            }
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }

        curl_close($ch);

        // Debug API response
        error_log("Request: $method $url");
        error_log("Payload: " . print_r($data, true));
        error_log("Response: $response");
        error_log("Status Code: $httpCode");

        return ['statusCode' => $httpCode, 'body' => json_decode($response, true)];
    }

    public function get($endpoint, $data = null)
    {
        return $this->request('GET', $endpoint, $data);
    }

    public function post($endpoint, $data, $isMultipart = false)
    {
        return $this->request('POST', $endpoint, $data, $isMultipart);
    }

    public function put($endpoint, $data)
    {
        return $this->request('PUT', $endpoint, $data);
    }

    public function delete($endpoint, $data = null)
    {
        return $this->request('DELETE', $endpoint, $data);
    }
}