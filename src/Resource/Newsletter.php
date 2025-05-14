<?php

/**
 * This file is part of waini/api-sdk
 *
 * @copyright Copyright (c) Wuri Nugrahadi <wuri.nugrahadi@gmail.com>
 * @license https://opensource.org/license/mit/ MIT License
 */

declare(strict_types=1);

namespace WuriN7i\ApiSdk\Resource;

use Saloon\Http\Response;
use WuriN7i\ApiSdk\Requests\Newsletter\UnfollowNewsletter;
use WuriN7i\ApiSdk\Resource;

class Newsletter extends Resource
{
    public function unfollowNewsletter(): Response
    {
        return $this->connector->send(new UnfollowNewsletter());
    }
}
