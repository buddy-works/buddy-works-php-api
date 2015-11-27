<?php
/**
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
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

use Buddy\Objects\Group;
use Buddy\Objects\User;

class Groups extends Api
{
    /**
     * @param string $domain
     * @param null|string $accessToken
     * @return \Buddy\Objects\Groups
     */
    public function getGroups($domain, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/groups', [
            'domain' => $domain
        ])->getAsGroups();
    }

    /**
     * @param Group $group
     * @param string $domain
     * @param null|string $accessToken
     * @return Group
     */
    public function addGroup(Group $group, $domain, $accessToken = null)
    {
        return $this->postJson($accessToken, [
            'name' => $group->getName(),
            'description' => $group->getDescription()
        ], '/workspaces/:domain/groups', [
            'domain' => $domain
        ])->getAsGroup();
    }

    /**
     * @param string $domain
     * @param int $groupId
     * @param null|string $accessToken
     * @return Group
     */
    public function getGroup($domain, $groupId, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/groups/:group_id', [
            'domain' => $domain,
            'group_id' => $groupId
        ])->getAsGroup();
    }

    /**
     * @param Group $group
     * @param string $domain
     * @param int $groupId
     * @param null|string $accessToken
     * @return Group
     */
    public function editGroup(Group $group, $domain, $groupId, $accessToken = null)
    {
        return $this->patchJson($accessToken, [
            'name' => $group->getName(),
            'description' => $group->getDescription()
        ], '/workspaces/:domain/groups/:group_id', [
            'domain' => $domain,
            'group_id' => $groupId
        ])->getAsGroup();
    }

    /**
     * @param string $domain
     * @param int $groupId
     * @param null|string $accessToken
     * @return bool
     */
    public function deleteGroup($domain, $groupId, $accessToken = null)
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/groups/:group_id', [
            'domain' => $domain,
            'group_id' => $groupId
        ])->getAsBool();
    }

    /**
     * @param string $domain
     * @param int $groupId
     * @param array $filters
     * @param null|string $accessToken
     * @return \Buddy\Objects\Members
     */
    public function getGroupMembers($domain, $groupId, array $filters = [], $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/groups/:group_id/members', [
            'domain' => $domain,
            'group_id' => $groupId
        ], $filters)->getAsMembers();
    }

    /**
     * @param User $user
     * @param string $domain
     * @param int $groupId
     * @param null|string $accessToken
     * @return User
     */
    public function addGroupMember(User $user, $domain, $groupId, $accessToken = null)
    {
        return $this->postJson($accessToken, [
            'id' => $user->getId()
        ], '/workspaces/:domain/groups/:group_id/members', [
            'domain' => $domain,
            'group_id' => $groupId
        ])->getAsUser();
    }

    /**
     * @param string $domain
     * @param int $groupId
     * @param int $memberId
     * @param null|string $accessToken
     * @return User
     */
    public function getGroupMember($domain, $groupId, $memberId, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/groups/:group_id/members/:member_id', [
            'domain' => $domain,
            'group_id' => $groupId,
            'member_id' => $memberId
        ])->getAsUser();
    }

    /**
     * @param string $domain
     * @param int $groupId
     * @param int $memberId
     * @param null|string $accessToken
     * @return bool
     */
    public function deleteGroupMember($domain, $groupId, $memberId, $accessToken = null)
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/groups/:group_id/members/:member_id', [
            'domain' => $domain,
            'group_id' => $groupId,
            'member_id' => $memberId
        ])->getAsBool();
    }
}
