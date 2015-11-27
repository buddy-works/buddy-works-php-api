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

use Buddy\Objects\User;

class Members extends Api
{
    /**
     * @param string $domain
     * @param array $filters
     * @param null|string $accessToken
     * @return \Buddy\Objects\Members
     */
    public function getWorkspaceMembers($domain, array $filters = [], $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/members', [
            'domain' => $domain
        ], $filters)->getAsMembers();
    }

    /**
     * @param User $user
     * @param string $domain
     * @param null|string $accessToken
     * @return User
     */
    public function addWorkspaceMember(User $user, $domain, $accessToken = null)
    {
        return $this->postJson($accessToken, [
            'email' => $user->getEmail()
        ], '/workspaces/:domain/members', [
            'domain' => $domain
        ])->getAsUser();
    }

    /**
     * @param string $domain
     * @param int $memberId
     * @param null|string $accessToken
     * @return User
     */
    public function getWorkspaceMember($domain, $memberId, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/members/:member_id', [
            'domain' => $domain,
            'member_id' => $memberId
        ])->getAsUser();
    }

    /**
     * @param User $user
     * @param string $domain
     * @param int $memberId
     * @param null|string $accessToken
     * @return User
     */
    public function editWorkspaceMember(User $user, $domain, $memberId, $accessToken = null)
    {
        return $this->patchJson($accessToken, [
            'admin' => $user->getAdmin()
        ], '/workspaces/:domain/members/:member_id', [
            'domain' => $domain,
            'member_id' => $memberId
        ])->getAsUser();
    }

    /**
     * @param string $domain
     * @param int $memberId
     * @param null|string $accessToken
     * @return bool
     */
    public function deleteWorkspaceMember($domain, $memberId, $accessToken = null)
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/members/:member_id', [
            'domain' => $domain,
            'member_id' => $memberId
        ])->getAsBool();
    }

    /**
     * @param string $domain
     * @param int $memberId
     * @param array $filters
     * @param null|string $accessToken
     * @return \Buddy\Objects\Projects
     */
    public function getWorkspaceMemberProjects($domain, $memberId, array $filters = [], $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/members/:member_id/projects', [
            'domain' => $domain,
            'member_id' => $memberId
        ], $filters)->getAsProjects();
    }
}
