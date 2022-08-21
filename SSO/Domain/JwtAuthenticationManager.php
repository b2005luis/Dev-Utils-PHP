<?php

namespace App\application\core;

class JwtAuthenticationManager
{
    private $headers;
    private $payload;
    private $secret;
    private $accessToken;

    /**
     * @return mixed
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param mixed $secret
     */
    public function setSecret($secret): void
    {
        $this->secret = $secret;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param mixed $accessToken
     */
    public function setAccessToken($accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return array
     */
    public function getPayload(): array
    {
        return $this->payload;
    }

    /**
     * @param array $payload
     */
    public function setPayload(array $payload): void
    {
        $this->payload = array(
            "sub" => $_SERVER["REQUEST_TIME"],
            "data" => $payload,
            "exp" => ($_SERVER["REQUEST_TIME"] + 300)
        );
    }

    public function __construct()
    {
        $this->headers = array(
            "alg" => "HS256",
            "typ" => "JWT"
        );
    }

    private function getAuthorizationHeader()
    {
        $headers = null;

        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } else if (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }

        return $headers;
    }

    public function getHeaderToken()
    {
        $headers = $this->getAuthorizationHeader();

        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }

        return null;
    }

    function generateToken()
    {
        $headers_encoded = $this->base64UrlEncode(json_encode($this->headers));
        $payload_encoded = $this->base64UrlEncode(json_encode($this->payload));

        $signature = hash_hmac('SHA256', "$headers_encoded.$payload_encoded", $this->secret, true);

        $signature_encoded = $this->base64UrlEncode($signature);

        $this->accessToken = "$headers_encoded.$payload_encoded.$signature_encoded";

        return $this->accessToken;
    }

    private function base64UrlEncode($value)
    {
        return rtrim(strtr(base64_encode($value), '+/', '-_'), '=');
    }

    public function isValidToken()
    {
        // Recovery token in tge authorization header
        $this->accessToken = $this->getHeaderToken();
        // split the jwt content token
        $tokenParts = explode(".", $this->accessToken);
        $header = base64_decode($tokenParts[0]);
        $payload = base64_decode($tokenParts[1]);
        $signature_provided = $tokenParts[2];

        // check the expiration time - note this will cause an error if there is no 'exp' claim in the jwt
        $expiration = json_decode($payload)->exp;
        $is_token_expired = ($expiration - time()) < 0;

        // build a signature based on the header and payload using the secret
        $base64_url_header = $this->base64UrlEncode($header);
        $base64_url_payload = $this->base64UrlEncode($payload);
        $signature = hash_hmac('SHA256', $base64_url_header . "." . $base64_url_payload, $this->secret, true);
        $base64_url_signature = $this->base64UrlEncode($signature);

        // verify it matches the signature provided in the jwt
        $is_signature_valid = ($base64_url_signature == $signature_provided);

        if ($is_token_expired || !$is_signature_valid) {
            return FALSE;
        } else {
            $this->setPayload(json_decode($payload, true)["data"]);
            return TRUE;
        }
    }
}
