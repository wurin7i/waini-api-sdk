<?php

/**
 * This file is part of waini/api-sdk
 *
 * @copyright Copyright (c) Wuri Nugrahadi <wuri.nugrahadi@gmail.com>
 * @license https://opensource.org/license/mit/ MIT License
 */

namespace WuriN7i\ApiSdk\Requests\Statics;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Static File QR Code
 */
class QrCode extends Request
{
	protected Method $method = Method::GET;

	public function __construct(
		protected string $fileName,
	) {
	}

	public function resolveEndpoint(): string
	{
		$pattern = '/scan-qr-[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}\.png$/';

		if (!preg_match($pattern, $this->fileName, $matches)) {
			throw new \InvalidArgumentException('Invalid file name format.');
		}

		return '/statics/qrcode/' . $matches[0];
	}
}
