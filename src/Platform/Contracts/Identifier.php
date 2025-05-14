<?php

declare(strict_types=1);

namespace WuriN7i\ApiSdk\Platform\Contracts;

interface Identifier
{
    public function getId(): string;

    public function __toString(): string;
}
