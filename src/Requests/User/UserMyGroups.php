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

/**
 * userMyGroups
 */
class UserMyGroups extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/user/my/groups';
    }

    public function __construct()
    {
    }
}
