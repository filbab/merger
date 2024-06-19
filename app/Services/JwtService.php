<?php

namespace App\Services;

use Firebase\JWT\JWT;

class JwtService
{
   const ALG = 'HS256';
   const TOKEN_VALIDITY = 3600;

    public function generateToken(string $login, string $system): string
    {
        $payload = [
            'login' => $login,
            'system' => $system,
            'iat' => time(),
            'exp' => time() + self::TOKEN_VALIDITY
        ];

        return JWT::encode($payload, env('JWT_SECRET'), self::ALG);
    }
}