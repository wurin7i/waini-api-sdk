<?php

/**
 * This file is part of waini/api-sdk
 *
 * @copyright Copyright (c) Wuri Nugrahadi <wuri.nugrahadi@gmail.com>
 * @license https://opensource.org/license/mit/ MIT License
 */

declare(strict_types=1);

namespace WuriN7i\ApiSdk\Auth;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use InvalidArgumentException;
use Saloon\Contracts\Authenticator;
use Saloon\Http\PendingRequest;
use Throwable;

use function file_exists;
use function file_get_contents;
use function file_put_contents;
use function hash;
use function is_array;
use function json_decode;
use function json_encode;
use function rtrim;
use function time;

use const DIRECTORY_SEPARATOR;

/**
 * SelfJwtAuthenticator
 *
 * This class is responsible for handling JWT-based authentication
 * for API requests. It generates, caches, and validates JWT tokens
 * to ensure secure communication with the API.
 */
class SelfJwtAuthenticator implements Authenticator
{
    /**
     * @var array<string, string>
     */
    protected array $config;
    protected string $tokenPath;

    /**
     * Constructor for SelfJwtAuthenticator.
     *
     * @param array<string, string> | string $config Configuration array or path to JSON file.
     */
    public function __construct(array | string $config, string $tokenCacheDir = '/tmp')
    {
        if (! is_array($config)) {
            $config = $this->loadConfigFromFile($config);
        }

        $this->validateConfig($config);
        $this->config = $config;
        $this->tokenPath = $this->generateTokenPath($config, $tokenCacheDir);
    }

    /**
     * Generate a unique token path based on the configuration.
     *
     * @param array<string, string> $config Configuration array.
     */
    protected function generateTokenPath(array $config, string $tokenCacheDir): string
    {
        // Generate cache filename based on hash of config content
        $jsonConfig = json_encode($config);
        if ($jsonConfig === false) {
            throw new InvalidArgumentException('Failed to encode configuration to JSON.');
        }
        $hash = hash('sha256', $jsonConfig);

        return rtrim($tokenCacheDir, DIRECTORY_SEPARATOR)
            . DIRECTORY_SEPARATOR
            . "waini__jwt_token_{$hash}.json";
    }

    /**
     * Load configuration from a JSON file.
     *
     * @return array<string, string> Decoded JSON configuration.
     */
    protected function loadConfigFromFile(string $configFile): array
    {
        $configContent = file_get_contents($configFile);
        if ($configContent === false) {
            throw new InvalidArgumentException("Failed to read configuration file: {$configFile}");
        }

        /** @var array<string, string>|false $decodedConfig */
        $decodedConfig = json_decode($configContent, true);
        if (!is_array($decodedConfig)) {
            throw new InvalidArgumentException("Invalid JSON configuration in file: {$configFile}");
        }

        return $decodedConfig;
    }

    /**
     * Validate the configuration array.
     *
     * @param array<string, string> $config Configuration array.
     */
    protected function validateConfig(array $config): void
    {
        if (!isset($config['key'], $config['secret'], $config['algorithm'])) {
            throw new InvalidArgumentException('Invalid configuration for JWT authentication.');
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
            $cached = $this->loadConfigFromFile($this->tokenPath);
            if (isset($cached['token']) && !$this->isExpired($cached['token'])) {
                return $cached['token'];
            }
        }

        $token = $this->generateJwtToken();

        $encodedData = json_encode([
            'token' => $token,
            'created_at' => time(),
        ]);

        if ($encodedData === false) {
            throw new InvalidArgumentException('Failed to encode token data to JSON.');
        }

        file_put_contents($this->tokenPath, $encodedData);

        return $token;
    }

    protected function generateJwtToken(): string
    {
        $payload = [
            'iss' => $this->config['key'],
            'iat' => time(),
            'exp' => time() + 3600,
        ];

        return JWT::encode($payload, $this->getConfig('secret'), $this->getConfig('algorithm'));
    }

    protected function isExpired(string $token): bool
    {
        try {
            $decoded = JWT::decode(
                $token,
                new Key($this->getConfig('secret'), $this->getConfig('algorithm')),
            );

            return ($decoded->exp ?? 0) < time();
        } catch (Throwable $e) {
            return true;
        }
    }

    protected function getConfig(string $key): string
    {
        if (!isset($this->config[$key])) {
            throw new InvalidArgumentException("Configuration key '{$key}' not found.");
        }

        return $this->config[$key];
    }
}
