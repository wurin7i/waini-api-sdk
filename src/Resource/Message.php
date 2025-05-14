<?php

/**
 * This file is part of waini/api-sdk
 *
 * @copyright Copyright (c) Wuri Nugrahadi <wuri.nugrahadi@gmail.com>
 * @license https://opensource.org/license/mit/ MIT License
 */

declare(strict_types=1);

namespace WuriN7i\ApiSdk\Resource;

use Saloon\Http\Response;
use WuriN7i\ApiSdk\Requests\Message\DeleteMessage;
use WuriN7i\ApiSdk\Requests\Message\ReactMessage;
use WuriN7i\ApiSdk\Requests\Message\ReadMessage;
use WuriN7i\ApiSdk\Requests\Message\RevokeMessage;
use WuriN7i\ApiSdk\Requests\Message\UpdateMessage;
use WuriN7i\ApiSdk\Resource;

class Message extends Resource
{
    /**
     * @param string $messageId Message ID
     */
    public function revokeMessage(string $messageId): Response
    {
        return $this->connector->send(new RevokeMessage($messageId));
    }

    /**
     * @param string $messageId Message ID
     */
    public function deleteMessage(string $messageId): Response
    {
        return $this->connector->send(new DeleteMessage($messageId));
    }

    /**
     * @param string $messageId Message ID
     */
    public function reactMessage(string $messageId): Response
    {
        return $this->connector->send(new ReactMessage($messageId));
    }

    /**
     * @param string $messageId Message ID
     */
    public function updateMessage(string $messageId): Response
    {
        return $this->connector->send(new UpdateMessage($messageId));
    }

    /**
     * @param string $messageId Message ID
     */
    public function readMessage(string $messageId): Response
    {
        return $this->connector->send(new ReadMessage($messageId));
    }
}
