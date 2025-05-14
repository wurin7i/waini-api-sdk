<?php

/**
 * This file is part of waini/api-sdk
 *
 * @copyright Copyright (c) Wuri Nugrahadi <wuri.nugrahadi@gmail.com>
 * @license https://opensource.org/license/mit/ MIT License
 */

declare(strict_types=1);

namespace WuriN7i\ApiSdk\Requests\User;

use Saloon\Enums\Method;
use Saloon\Http\Request;

use function array_filter;

/**
 * userInfo
 */
class UserInfo extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/user/info';
    }

    /**
     * @param string|null $phone Phone number with country code
     */
    public function __construct(
        protected ?string $phone = null,
    ) {
    }

    /**
     * @return array<string, string|null>
     */
    public function defaultQuery(): array
    {
        return array_filter(['phone' => $this->phone]);
    }
}
