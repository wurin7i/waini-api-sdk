<?php

/**
 * This file is part of waini/api-sdk
 *
 * @copyright Copyright (c) Wuri Nugrahadi <wuri.nugrahadi@gmail.com>
 * @license https://opensource.org/license/mit/ MIT License
 */

namespace WuriN7i\ApiSdk;

use Saloon\Http\Connector;
use WuriN7i\ApiSdk\Resource\App;
use WuriN7i\ApiSdk\Resource\Group;
use WuriN7i\ApiSdk\Resource\Message;
use WuriN7i\ApiSdk\Resource\Newsletter;
use WuriN7i\ApiSdk\Resource\Send;
use WuriN7i\ApiSdk\Resource\Statics;
use WuriN7i\ApiSdk\Resource\User;

/**
 * WhatsApp API MultiDevice
 *
 * This API is used for sending whatsapp via API
 */
class WainiApiSdk extends Connector
{
	public function __construct(
		protected string $baseUrl
	) {
	}

	public function resolveBaseUrl(): string
	{
		return $this->baseUrl;
	}


	public function appApi(): App
	{
		return new App($this);
	}


	public function groupApi(): Group
	{
		return new Group($this);
	}


	public function messageApi(): Message
	{
		return new Message($this);
	}


	public function newsletterApi(): Newsletter
	{
		return new Newsletter($this);
	}


	public function sendApi(): Send
	{
		return new Send($this);
	}


	public function userApi(): User
	{
		return new User($this);
	}

	public function statics(): Statics
	{
		return new Statics($this);
	}
}
