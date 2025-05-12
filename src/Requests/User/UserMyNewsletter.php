<?php

/**
 * This file is part of waini/api-sdk
 *
 * @copyright Copyright (c) Wuri Nugrahadi <wuri.nugrahadi@gmail.com>
 * @license https://opensource.org/license/mit/ MIT License
 */

namespace WuriN7i\ApiSdk\Requests\User;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * userMyNewsletter
 */
class UserMyNewsletter extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/user/my/newsletters";
	}


	public function __construct()
	{
	}
}
