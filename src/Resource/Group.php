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
use WuriN7i\ApiSdk\Requests\Group\AddParticipantToGroup;
use WuriN7i\ApiSdk\Requests\Group\ApproveGroupParticipantRequest;
use WuriN7i\ApiSdk\Requests\Group\CreateGroup;
use WuriN7i\ApiSdk\Requests\Group\DemoteParticipantToMember;
use WuriN7i\ApiSdk\Requests\Group\GetGroupParticipantRequests;
use WuriN7i\ApiSdk\Requests\Group\JoinGroupWithLink;
use WuriN7i\ApiSdk\Requests\Group\LeaveGroup;
use WuriN7i\ApiSdk\Requests\Group\PromoteParticipantToAdmin;
use WuriN7i\ApiSdk\Requests\Group\RejectGroupParticipantRequest;
use WuriN7i\ApiSdk\Requests\Group\RemoveParticipantFromGroup;
use WuriN7i\ApiSdk\Resource;

class Group extends Resource
{
    public function createGroup(): Response
    {
        return $this->connector->send(new CreateGroup());
    }

    public function addParticipantToGroup(): Response
    {
        return $this->connector->send(new AddParticipantToGroup());
    }

    public function removeParticipantFromGroup(): Response
    {
        return $this->connector->send(new RemoveParticipantFromGroup());
    }

    public function promoteParticipantToAdmin(): Response
    {
        return $this->connector->send(new PromoteParticipantToAdmin());
    }

    public function demoteParticipantToMember(): Response
    {
        return $this->connector->send(new DemoteParticipantToMember());
    }

    public function joinGroupWithLink(): Response
    {
        return $this->connector->send(new JoinGroupWithLink());
    }

    /**
     * @param string $groupId The group ID to get participant requests for
     */
    public function getGroupParticipantRequests(string $groupId): Response
    {
        return $this->connector->send(new GetGroupParticipantRequests($groupId));
    }

    public function approveGroupParticipantRequest(): Response
    {
        return $this->connector->send(new ApproveGroupParticipantRequest());
    }

    public function rejectGroupParticipantRequest(): Response
    {
        return $this->connector->send(new RejectGroupParticipantRequest());
    }

    public function leaveGroup(): Response
    {
        return $this->connector->send(new LeaveGroup());
    }
}
