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

class Permissions extends Api
{
    public const PIPELINE_ACCESS_LEVEL_DENIED = 'DENIED';
    public const PIPELINE_ACCESS_LEVEL_READ_ONLY = 'READ_ONLY';
    public const PIPELINE_ACCESS_LEVEL_RUN_ONLY = 'RUN_ONLY';
    public const PIPELINE_ACCESS_LEVEL_READ_WRITE = 'READ_WRITE';

    public const REPOSITORY_ACCESS_LEVEL_DENIED = 'DENIED';
    public const REPOSITORY_ACCESS_LEVEL_READ_ONLY = 'READ_ONLY';
    public const REPOSITORY_ACCESS_LEVEL_READ_WRITE = 'READ_WRITE';

    public function getWorkspacePermissions(string $domain, ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/permissions', [
            'domain' => $domain,
        ]);
    }

    /**
     * @param mixed[] $data
     */
    public function addWorkspacePermission(array $data, string $domain, ?string $accessToken = null): BuddyResponse
    {
        return $this->postJson($accessToken, $data, '/workspaces/:domain/permissions', [
            'domain' => $domain,
        ]);
    }

    public function getWorkspacePermission(string $domain, int $permissionId, ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/permissions/:permission_set_id', [
            'domain' => $domain,
            'permission_set_id' => $permissionId,
        ]);
    }

    /**
     * @param mixed[] $data
     */
    public function editWorkspacePermission(array $data, string $domain, int $permissionId, ?string $accessToken = null): BuddyResponse
    {
        return $this->patchJson($accessToken, $data, '/workspaces/:domain/permissions/:permission_set_id', [
            'domain' => $domain,
            'permission_set_id' => $permissionId,
        ]);
    }

    public function deleteWorkspacePermission(string $domain, int $permissionId, ?string $accessToken = null): BuddyResponse
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/permissions/:permission_set_id', [
            'domain' => $domain,
            'permission_set_id' => $permissionId,
        ]);
    }
}
