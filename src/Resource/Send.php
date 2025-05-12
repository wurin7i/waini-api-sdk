<?php

/**
 * This file is part of waini/api-sdk
 *
 * @copyright Copyright (c) Wuri Nugrahadi <wuri.nugrahadi@gmail.com>
 * @license https://opensource.org/license/mit/ MIT License
 */

namespace WuriN7i\ApiSdk\Resource;

use Saloon\Http\Response;
use WuriN7i\ApiSdk\Requests\Send\SendAudio;
use WuriN7i\ApiSdk\Requests\Send\SendContact;
use WuriN7i\ApiSdk\Requests\Send\SendFile;
use WuriN7i\ApiSdk\Requests\Send\SendImage;
use WuriN7i\ApiSdk\Requests\Send\SendLink;
use WuriN7i\ApiSdk\Requests\Send\SendLocation;
use WuriN7i\ApiSdk\Requests\Send\SendMessage;
use WuriN7i\ApiSdk\Requests\Send\SendPoll;
use WuriN7i\ApiSdk\Requests\Send\SendPresence;
use WuriN7i\ApiSdk\Requests\Send\SendVideo;
use WuriN7i\ApiSdk\Resource;

class Send extends Resource
{
	public function sendMessage(): Response
	{
		return $this->connector->send(new SendMessage());
	}


	public function sendImage(): Response
	{
		return $this->connector->send(new SendImage());
	}


	public function sendAudio(): Response
	{
		return $this->connector->send(new SendAudio());
	}


	public function sendFile(): Response
	{
		return $this->connector->send(new SendFile());
	}


	public function sendVideo(): Response
	{
		return $this->connector->send(new SendVideo());
	}


	public function sendContact(): Response
	{
		return $this->connector->send(new SendContact());
	}


	public function sendLink(): Response
	{
		return $this->connector->send(new SendLink());
	}


	public function sendLocation(): Response
	{
		return $this->connector->send(new SendLocation());
	}


	public function sendPoll(): Response
	{
		return $this->connector->send(new SendPoll());
	}


	public function sendPresence(): Response
	{
		return $this->connector->send(new SendPresence());
	}
}
