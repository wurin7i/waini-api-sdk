<?php

/**
 * This file is part of waini/api-sdk
 *
 * @copyright Copyright (c) Wuri Nugrahadi <wuri.nugrahadi@gmail.com>
 * @license https://opensource.org/license/mit/ MIT License
 */

namespace WuriN7i\ApiSdk\Requests\Send;

use DateTime;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * sendMessage
 */
class SendMessage extends Request implements HasBody
{
	use HasJsonBody;

	protected Method $method = Method::POST;

	public function resolveEndpoint(): string
	{
		return "/send/message";
	}

	public function __construct(
		protected readonly string $to,
		protected readonly string $message,
		protected readonly ?string $repliedMessageId = null,
	) {}

	public function repliedMessage(string $messageId): static
	{
		$this->repliedMessageId = $messageId;
		return $this;
	}

	public function defaultBody(): array
	{
		return [
			'phone' => $this->to,
			'message' => $this->message,
			'reply_message_id' => $this->repliedMessageId,
		];
	}
}
