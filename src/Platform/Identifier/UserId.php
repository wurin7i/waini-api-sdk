<?php

declare(strict_types=1);

namespace WuriN7i\ApiSdk\Platform\Identifier;

use WuriN7i\ApiSdk\Platform\Contracts\Identifier;

final class UserId implements Identifier
{
    public function getId(): string
    {
        return '';
    }

    public function __toString(): string
    {
        return '';
    }
}
