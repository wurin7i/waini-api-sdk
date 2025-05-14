<?php

/**
 * This file is part of waini/api-sdk
 *
 * @copyright Copyright (c) Wuri Nugrahadi <wuri.nugrahadi@gmail.com>
 * @license https://opensource.org/license/mit/ MIT License
 */

declare(strict_types=1);

namespace WuriN7i\ApiSdk;

use Saloon\Http\Connector;

class Resource
{
    public function __construct(
        protected Connector $connector,
        protected ?string $accountNumber = null,
    ) {
    }
}
