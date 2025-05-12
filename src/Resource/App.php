<?php

/**
 * This file is part of waini/api-sdk
 *
 * @copyright Copyright (c) Wuri Nugrahadi <wuri.nugrahadi@gmail.com>
 * @license https://opensource.org/license/mit/ MIT License
 */

namespace WuriN7i\ApiSdk\Resource;

use Saloon\Http\Response;
use WuriN7i\ApiSdk\Requests\App\AppDevices;
use WuriN7i\ApiSdk\Requests\App\AppLogin;
use WuriN7i\ApiSdk\Requests\App\AppLoginWithCode;
use WuriN7i\ApiSdk\Requests\App\AppLogout;
use WuriN7i\ApiSdk\Requests\App\AppQrLogin;
use WuriN7i\ApiSdk\Requests\App\AppReconnect;
use WuriN7i\ApiSdk\Resource;

class App extends Resource
{
	public function appLogin(): Response
	{
		return $this->connector->send(new AppLogin());
	}

	public function appLoginWithCode(?string $phone = null): Response
	{
		$phone = $phone ?? $this->accountNumber;
		return $this->connector->send(new AppLoginWithCode($phone));
	}

	public function appLogout(): Response
	{
		return $this->connector->send(new AppLogout());
	}


	public function appReconnect(): Response
	{
		return $this->connector->send(new AppReconnect());
	}


	public function appDevices(): Response
	{
		return $this->connector->send(new AppDevices());
	}
}
