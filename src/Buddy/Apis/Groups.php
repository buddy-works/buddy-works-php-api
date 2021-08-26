<?php

declare(strict_types=1);
/**
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at.
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Buddy\Apis;

use Buddy\BuddyResponse;

class Groups extends Api
{
    public function getGroups(string $domain, ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/groups', [
            'domain' => $domain,
        ]);
    }

    /**
     * @param mixed[] $data
     */
    public function addGroup(array $data, string $domain, ?string $accessToken = null): BuddyResponse
    {
        return $this->postJson($accessToken, $data, '/workspaces/:domain/groups', [
            'domain' => $domain,
        ]);
    }

    public function getGroup(string $domain, int $groupId, ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/groups/:group_id', [
            'domain' => $domain,
            'group_id' => $groupId,
        ]);
    }

    /**
     * @param mixed[] $data
     */
    public function editGroup(array $data, string $domain, int $groupId, ?string $accessToken = null): BuddyResponse
    {
        return $this->patchJson($accessToken, $data, '/workspaces/:domain/groups/:group_id', [
            'domain' => $domain,
            'group_id' => $groupId,
        ]);
    }

    public function deleteGroup(string $domain, int $groupId, ?string $accessToken = null): BuddyResponse
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/groups/:group_id', [
            'domain' => $domain,
            'group_id' => $groupId,
        ]);
    }

    public function getGroupMembers(string $domain, int $groupId, ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/groups/:group_id/members', [
            'domain' => $domain,
            'group_id' => $groupId,
        ]);
    }

    public function addGroupMember(string $domain, int $groupId, int $userId, ?string $accessToken = null): BuddyResponse
    {
        return $this->postJson($accessToken, [
            'id' => $userId,
        ], '/workspaces/:domain/groups/:group_id/members', [
            'domain' => $domain,
            'group_id' => $groupId,
        ]);
    }

    public function getGroupMember(string $domain, int $groupId, int $userId, ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/groups/:group_id/members/:member_id', [
            'domain' => $domain,
            'group_id' => $groupId,
            'member_id' => $userId,
        ]);
    }

    public function deleteGroupMember(string $domain, int $groupId, int $userId, ?string $accessToken = null): BuddyResponse
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/groups/:group_id/members/:member_id', [
            'domain' => $domain,
            'group_id' => $groupId,
            'member_id' => $userId,
        ]);
    }
}
