<?php

use Firebase\JWT\JWT;

class JwtHelper
{
    private static $secretKey = "666";
    private static $issuedAt;
    private static $expirationTime = 3600;
    private static $audience = "vetconnectapp";
    private static $issuer = "api.vetconnect";

    public static function encode($data)
    {
        self::$issuedAt = time();
        $expirationTime = self::$issuedAt + self::$expirationTime;

        $payload = [
            'iat' => self::$issuedAt,
            'exp' => $expirationTime,
            'aud' => self::$audience,
            'iss' => self::$issuer,
            'data' => $data
        ];

        return JWT::encode($payload, self::$secretKey, 'HS256');
    }
    public static function decode($jwt)
    {
        try {
            return JWT::decode($jwt, self::$secretKey);
        } catch (Exception $e) {
            throw new Exception("Invalid token: " . $e->getMessage());
        }
    }
}
