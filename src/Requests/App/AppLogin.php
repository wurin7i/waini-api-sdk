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
 * appLogin
 */
class AppLogin extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/app/login";
	}


	public function __construct()
	{
	}
}
