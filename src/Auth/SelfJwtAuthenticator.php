<?php

/**
 * This file is part of waini/api-sdk
 *
 * @copyright Copyright (c) Wuri Nugrahadi <wuri.nugrahadi@gmail.com>
 * @license https://opensource.org/license/mit/ MIT License
 */

namespace WuriN7i\ApiSdk\Auth;

use Saloon\Contracts\Authenticator;
use Saloon\Http\PendingRequest;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * SelfJwtAuthenticator
 *
 * This class is responsible for handling JWT-based authentication
 * for API requests. It generates, caches, and validates JWT tokens
 * to ensure secure communication with the API.
 */
class SelfJwtAuthenticator implements Authenticator
{
    protected array $config;
    protected string $tokenPath;

    public function __construct(array|string $config, string $tokenCacheDir = '/tmp')
    {
        if (!is_array($config)) {
            $config = $this->loadConfigFromFile($config);
        }

        $this->validateConfig($config);
        $this->config = $config;

        // Generate cache filename based on hash of config content
        $hash = hash('sha256', json_encode($config));
        $this->tokenPath = rtrim($tokenCacheDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . "waini__jwt_token_{$hash}.json";
    }

    protected function loadConfigFromFile(string $configFile): array
    {
        $configContent = file_get_contents($configFile);
        return json_decode($configContent, true);
    }

    protected function validateConfig(array $config): void
    {
        if (!isset($config['key'], $config['secret'], $config['algorithm'])) {
            throw new \InvalidArgumentException('Invalid configuration for JWT authentication.');
        }
    }

    public function set(PendingRequest $pendingRequest): void
    {
        $token = $this->getOrCreateToken();
        $pendingRequest->headers()->add('Authorization', 'Bearer ' . $token);
    }

    protected function getOrCreateToken(): string
    {
        if (file_exists($this->tokenPath)) {
            $cached = json_decode(file_get_contents($this->tokenPath), true);
            if (!empty($cached['token']) && !$this->isExpired($cached['token'])) {
                return $cached['token'];
            }
        }

        $token = $this->generateJwtToken();

        file_put_contents($this->tokenPath, json_encode([
            'token' => $token,
            'created_at' => time()
        ]));

        return $token;
    }

    protected function generateJwtToken(): string
    {
        $payload = [
            'iss' => $this->config['key'],
            'iat' => time(),
            'exp' => time() + 3600,
        ];

        return JWT::encode($payload, $this->config['secret'], $this->config['algorithm']);
    }

    protected function isExpired(string $token): bool
    {
        try {
            $decoded = JWT::decode($token, new Key($this->config['secret'], $this->config['algorithm']));
            return ($decoded->exp ?? 0) < time();
        } catch (\Exception $e) {
            return true;
        }
    }
}
