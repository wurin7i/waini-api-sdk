<?php

/**
 * This file is part of waini/api-sdk
 *
 * @copyright Copyright (c) Wuri Nugrahadi <wuri.nugrahadi@gmail.com>
 * @license https://opensource.org/license/mit/ MIT License
 */

namespace WuriN7i\ApiSdk\Resource;

use Saloon\Http\Response;
use WuriN7i\ApiSdk\Requests\Statics\QrCode;
use WuriN7i\ApiSdk\Resource;

class Statics extends Resource
{
	public function QrCode(string $fileName): Response
	{
		return $this->connector->send(new QrCode($fileName));
	}
}
