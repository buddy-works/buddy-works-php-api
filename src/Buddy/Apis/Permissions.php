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

class Permissions extends Api
{
    const PIPELINE_ACCESS_LEVEL_DENIED = 'DENIED';
    const PIPELINE_ACCESS_LEVEL_READ_ONLY = 'READ_ONLY';
    const PIPELINE_ACCESS_LEVEL_RUN_ONLY = 'RUN_ONLY';
    const PIPELINE_ACCESS_LEVEL_READ_WRITE = 'READ_WRITE';

    const REPOSITORY_ACCESS_LEVEL_DENIED = 'DENIED';
    const REPOSITORY_ACCESS_LEVEL_READ_ONLY = 'READ_ONLY';
    const REPOSITORY_ACCESS_LEVEL_READ_WRITE = 'READ_WRITE';

    /**
     * @param string      $domain
     * @param string|null $accessToken
     *
     * @return \Buddy\BuddyResponse
     */
    public function getWorkspacePermissions($domain, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/permissions', [
            'domain' => $domain,
        ]);
    }

    /**
     * @param array       $data
     * @param string      $domain
     * @param string|null $accessToken
     *
     * @return \Buddy\BuddyResponse
     */
    public function addWorkspacePermission($data, $domain, $accessToken = null)
    {
        return $this->postJson($accessToken, $data, '/workspaces/:domain/permissions', [
            'domain' => $domain,
        ]);
    }

    /**
     * @param string      $domain
     * @param int         $permissionId
     * @param string|null $accessToken
     *
     * @return \Buddy\BuddyResponse
     */
    public function getWorkspacePermission($domain, $permissionId, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/permissions/:permission_set_id', [
            'domain' => $domain,
            'permission_set_id' => $permissionId,
        ]);
    }

    /**
     * @param array       $data
     * @param string      $domain
     * @param int         $permissionId
     * @param string|null $accessToken
     *
     * @return \Buddy\BuddyResponse
     */
    public function editWorkspacePermission($data, $domain, $permissionId, $accessToken = null)
    {
        return $this->patchJson($accessToken, $data, '/workspaces/:domain/permissions/:permission_set_id', [
            'domain' => $domain,
            'permission_set_id' => $permissionId,
        ]);
    }

    /**
     * @param string      $domain
     * @param int         $permissionId
     * @param string|null $accessToken
     *
     * @return \Buddy\BuddyResponse
     */
    public function deleteWorkspacePermission($domain, $permissionId, $accessToken = null)
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/permissions/:permission_set_id', [
            'domain' => $domain,
            'permission_set_id' => $permissionId,
        ]);
    }
}
