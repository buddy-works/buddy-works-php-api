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

class Members extends Api
{
    /**
     * @param mixed[] $filters
     */
    public function getWorkspaceMembers(string $domain, array $filters = [], ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/members', [
            'domain' => $domain,
        ], $filters);
    }

    public function addWorkspaceMember(string $domain, string $email, ?string $accessToken = null): BuddyResponse
    {
        return $this->postJson($accessToken, [
            'email' => $email,
        ], '/workspaces/:domain/members', [
            'domain' => $domain,
        ]);
    }

    public function getWorkspaceMember(string $domain, int $userId, ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/members/:member_id', [
            'domain' => $domain,
            'member_id' => $userId,
        ]);
    }

    public function editWorkspaceMember(string $domain, int $userId, bool $isAdmin, ?string $accessToken = null): BuddyResponse
    {
        return $this->patchJson($accessToken, [
            'admin' => $isAdmin,
        ], '/workspaces/:domain/members/:member_id', [
            'domain' => $domain,
            'member_id' => $userId,
        ]);
    }

    public function deleteWorkspaceMember(string $domain, int $userId, ?string $accessToken = null): BuddyResponse
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/members/:member_id', [
            'domain' => $domain,
            'member_id' => $userId,
        ]);
    }

    /**
     * @param mixed[] $filters
     */
    public function getWorkspaceMemberProjects(string $domain, int $userId, array $filters = [], ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/members/:member_id/projects', [
            'domain' => $domain,
            'member_id' => $userId,
        ], $filters);
    }
}
