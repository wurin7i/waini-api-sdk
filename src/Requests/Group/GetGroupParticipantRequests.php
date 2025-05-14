<?php

/**
 * This file is part of waini/api-sdk
 *
 * @copyright Copyright (c) Wuri Nugrahadi <wuri.nugrahadi@gmail.com>
 * @license https://opensource.org/license/mit/ MIT License
 */

declare(strict_types=1);

namespace WuriN7i\ApiSdk\Requests\Group;

use Saloon\Enums\Method;
use Saloon\Http\Request;

use function array_filter;

/**
 * getGroupParticipantRequests
 */
class GetGroupParticipantRequests extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/group/participant-requests';
    }

    /**
     * @param string $groupId The group ID to get participant requests for
     */
    public function __construct(
        protected string $groupId,
    ) {
    }

    /**
     * @return array<string, string>
     */
    public function defaultQuery(): array
    {
        return array_filter(['group_id' => $this->groupId]);
    }
}
