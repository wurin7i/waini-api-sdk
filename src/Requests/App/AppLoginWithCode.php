<?php

/**
 * This file is part of waini/api-sdk
 *
 * @copyright Copyright (c) Wuri Nugrahadi <wuri.nugrahadi@gmail.com>
 * @license https://opensource.org/license/mit/ MIT License
 */

namespace WuriN7i\ApiSdk\Requests\App;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * appLoginWithCode
 */
class AppLoginWithCode extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/app/login-with-code";
	}


	/**
	 * @param null|string $phone Your phone number
	 */
	public function __construct(
		protected ?string $phone = null,
	) {
	}


	public function defaultQuery(): array
	{
		return array_filter(['phone' => $this->phone]);
	}
}
