<?php

/**
 * This file is part of waini/api-sdk
 *
 * @copyright Copyright (c) Wuri Nugrahadi <wuri.nugrahadi@gmail.com>
 * @license https://opensource.org/license/mit/ MIT License
 */

declare(strict_types=1);

namespace WuriN7i\ApiSdk\Requests\App;

use Saloon\Enums\Method;
use Saloon\Http\Request;

use function array_filter;

/**
 * appLoginWithCode
 */
class AppLoginWithCode extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param string|null $phone Your phone number
     */
    public function __construct(
        protected ?string $phone = null,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/app/login-with-code';
    }

    /**
     * @return array<string, string|null>
     */
    public function defaultQuery(): array
    {
        return array_filter(['phone' => $this->phone]);
    }
}
