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

class Groups extends Api
{
    /**
     * @param string $domain
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function getGroups($domain, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/groups', [
            'domain' => $domain
        ]);
    }

    /**
     * @param array $data
     * @param string $domain
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function addGroup($data, $domain, $accessToken = null)
    {
        return $this->postJson($accessToken, $data, '/workspaces/:domain/groups', [
            'domain' => $domain
        ]);
    }

    /**
     * @param string $domain
     * @param int $groupId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function getGroup($domain, $groupId, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/groups/:group_id', [
            'domain' => $domain,
            'group_id' => $groupId
        ]);
    }

    /**
     * @param array $data
     * @param string $domain
     * @param int $groupId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function editGroup($data, $domain, $groupId, $accessToken = null)
    {
        return $this->patchJson($accessToken, $data, '/workspaces/:domain/groups/:group_id', [
            'domain' => $domain,
            'group_id' => $groupId
        ]);
    }

    /**
     * @param string $domain
     * @param int $groupId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function deleteGroup($domain, $groupId, $accessToken = null)
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/groups/:group_id', [
            'domain' => $domain,
            'group_id' => $groupId
        ]);
    }

    /**
     * @param string $domain
     * @param int $groupId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function getGroupMembers($domain, $groupId, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/groups/:group_id/members', [
            'domain' => $domain,
            'group_id' => $groupId
        ]);
    }

    /**
     * @param string $domain
     * @param int $groupId
     * @param int $userId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function addGroupMember($domain, $groupId, $userId, $accessToken = null)
    {
        return $this->postJson($accessToken, [
            'id' => $userId
        ], '/workspaces/:domain/groups/:group_id/members', [
            'domain' => $domain,
            'group_id' => $groupId
        ]);
    }

    /**
     * @param string $domain
     * @param int $groupId
     * @param int $userId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function getGroupMember($domain, $groupId, $userId, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/groups/:group_id/members/:member_id', [
            'domain' => $domain,
            'group_id' => $groupId,
            'member_id' => $userId
        ]);
    }

    /**
     * @param string $domain
     * @param int $groupId
     * @param int $userId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function deleteGroupMember($domain, $groupId, $userId, $accessToken = null)
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/groups/:group_id/members/:member_id', [
            'domain' => $domain,
            'group_id' => $groupId,
            'member_id' => $userId
        ]);
    }
}
