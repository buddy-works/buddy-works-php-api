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

class Members extends Api
{
    /**
     * @param string      $domain
     * @param string|null $accessToken
     *
     * @return \Buddy\BuddyResponse
     */
    public function getWorkspaceMembers($domain, array $filters = [], $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/members', [
            'domain' => $domain,
        ], $filters);
    }

    /**
     * @param string      $domain
     * @param string      $email
     * @param string|null $accessToken
     *
     * @return \Buddy\BuddyResponse
     */
    public function addWorkspaceMember($domain, $email, $accessToken = null)
    {
        return $this->postJson($accessToken, [
            'email' => $email,
        ], '/workspaces/:domain/members', [
            'domain' => $domain,
        ]);
    }

    /**
     * @param string      $domain
     * @param int         $userId
     * @param string|null $accessToken
     *
     * @return \Buddy\BuddyResponse
     */
    public function getWorkspaceMember($domain, $userId, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/members/:member_id', [
            'domain' => $domain,
            'member_id' => $userId,
        ]);
    }

    /**
     * @param string      $domain
     * @param int         $userId
     * @param bool        $isAdmin
     * @param string|null $accessToken
     *
     * @return \Buddy\BuddyResponse
     */
    public function editWorkspaceMember($domain, $userId, $isAdmin, $accessToken = null)
    {
        return $this->patchJson($accessToken, [
            'admin' => $isAdmin,
        ], '/workspaces/:domain/members/:member_id', [
            'domain' => $domain,
            'member_id' => $userId,
        ]);
    }

    /**
     * @param string      $domain
     * @param int         $userId
     * @param string|null $accessToken
     *
     * @return \Buddy\BuddyResponse
     */
    public function deleteWorkspaceMember($domain, $userId, $accessToken = null)
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/members/:member_id', [
            'domain' => $domain,
            'member_id' => $userId,
        ]);
    }

    /**
     * @param string      $domain
     * @param int         $userId
     * @param string|null $accessToken
     *
     * @return \Buddy\BuddyResponse
     */
    public function getWorkspaceMemberProjects($domain, $userId, array $filters = [], $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/members/:member_id/projects', [
            'domain' => $domain,
            'member_id' => $userId,
        ], $filters);
    }
}
