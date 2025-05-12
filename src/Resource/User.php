<?php

/**
 * This file is part of waini/api-sdk
 *
 * @copyright Copyright (c) Wuri Nugrahadi <wuri.nugrahadi@gmail.com>
 * @license https://opensource.org/license/mit/ MIT License
 */

namespace WuriN7i\ApiSdk\Resource;

use Saloon\Http\Response;
use WuriN7i\ApiSdk\Requests\User\UserAvatar;
use WuriN7i\ApiSdk\Requests\User\UserChangeAvatar;
use WuriN7i\ApiSdk\Requests\User\UserChangePushName;
use WuriN7i\ApiSdk\Requests\User\UserInfo;
use WuriN7i\ApiSdk\Requests\User\UserMyContacts;
use WuriN7i\ApiSdk\Requests\User\UserMyGroups;
use WuriN7i\ApiSdk\Requests\User\UserMyNewsletter;
use WuriN7i\ApiSdk\Requests\User\UserMyPrivacy;
use WuriN7i\ApiSdk\Resource;

class User extends Resource
{
	/**
	 * @param string $phone Phone number with country code
	 */
	public function userInfo(?string $phone): Response
	{
		return $this->connector->send(new UserInfo($phone));
	}


	/**
	 * @param string $phone Phone number with country code
	 * @param bool $isPreview Whether to fetch a preview of the avatar
	 */
	public function userAvatar(?string $phone, ?bool $isPreview): Response
	{
		return $this->connector->send(new UserAvatar($phone, $isPreview));
	}


	public function userChangeAvatar(): Response
	{
		return $this->connector->send(new UserChangeAvatar());
	}


	public function userChangePushName(): Response
	{
		return $this->connector->send(new UserChangePushName());
	}


	public function userMyPrivacy(): Response
	{
		return $this->connector->send(new UserMyPrivacy());
	}


	public function userMyGroups(): Response
	{
		return $this->connector->send(new UserMyGroups());
	}


	public function userMyNewsletter(): Response
	{
		return $this->connector->send(new UserMyNewsletter());
	}


	public function userMyContacts(): Response
	{
		return $this->connector->send(new UserMyContacts());
	}
}
