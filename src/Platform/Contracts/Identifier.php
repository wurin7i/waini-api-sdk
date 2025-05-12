<?php

namespace WuriN7i\ApiSdk\Platform\Contracts;

interface Identifier
{
    public function getId(): string;

    public function __toString(): string;
}
