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

use Buddy\Objects\PermissionSet;

class Permissions extends Api
{
    /**
     * @param string $domain
     * @param null|string $accessToken
     * @return \Buddy\Objects\PermissionSets
     */
    public function getWorkspacePermissions($domain, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/permissions', [
            'domain' => $domain
        ])->getAsPermissionSets();
    }

    /**
     * @param PermissionSet $permission
     * @param string $domain
     * @param null|string $accessToken
     * @return PermissionSet
     */
    public function addWorkspacePermission(PermissionSet $permission, $domain, $accessToken = null)
    {
        return $this->postJson($accessToken, [
           'name' => $permission->getName(),
            'description' => $permission->getDescription(),
            'repository_access_level' => $permission->getRepositoryAccessLevel(),
            'release_scenario_access_level' => $permission->getReleaseScenarioAccessLevel()
        ], '/workspaces/:domain/permissions', [
            'domain' => $domain
        ])->getAsPermissionSet();
    }

    /**
     * @param string $domain
     * @param int $permissionId
     * @param null|string $accessToken
     * @return PermissionSet
     */
    public function getWorkspacePermission($domain, $permissionId, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/permissions/:permission_set_id', [
            'domain' => $domain,
            'permission_set_id' => $permissionId
        ])->getAsPermissionSet();
    }

    /**
     * @param PermissionSet $permission
     * @param string $domain
     * @param int $permissionId
     * @param null|string $accessToken
     * @return PermissionSet
     */
    public function editWorkspacePermission(PermissionSet $permission, $domain, $permissionId, $accessToken = null)
    {
        return $this->patchJson($accessToken, [
            'description' => $permission->getDescription(),
            'name' => $permission->getName(),
            'repository_access_level' => $permission->getRepositoryAccessLevel(),
            'release_scenario_access_level' => $permission->getReleaseScenarioAccessLevel()
        ], '/workspaces/:domain/permissions/:permission_set_id', [
            'domain' => $domain,
            'permission_set_id' => $permissionId
        ])->getAsPermissionSet();
    }

    /**
     * @param string $domain
     * @param int $permissionId
     * @param null|string $accessToken
     * @return bool
     */
    public function deleteWorkspacePermission($domain, $permissionId, $accessToken = null)
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/permissions/:permission_set_id', [
            'domain' => $domain,
            'permission_set_id' => $permissionId
        ])->getAsBool();
    }
}
