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

class Projects extends Api
{
    /**
     * @param mixed[] $filters
     */
    public function getProjects(string $domain, array $filters = [], ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects', [
            'domain' => $domain,
        ], $filters);
    }

    /**
     * @param mixed[] $data
     */
    public function addProject(array $data, string $domain, ?string $accessToken = null): BuddyResponse
    {
        return $this->postJson($accessToken, $data, '/workspaces/:domain/projects', [
            'domain' => $domain,
        ]);
    }

    public function getProject(string $domain, string $projectName, ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name', [
            'domain' => $domain,
            'project_name' => $projectName,
        ]);
    }

    /**
     * @param mixed[] $data
     */
    public function editProject(array $data, string $domain, string $projectName, ?string $accessToken = null): BuddyResponse
    {
        return $this->patchJson($accessToken, $data, '/workspaces/:domain/projects/:project_name', [
            'domain' => $domain,
            'project_name' => $projectName,
        ]);
    }

    public function deleteProject(string $domain, string $projectName, ?string $accessToken = null): BuddyResponse
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/projects/:project_name', [
            'domain' => $domain,
            'project_name' => $projectName,
        ]);
    }

    /**
     * @param mixed[] $filters
     */
    public function getProjectMembers(string $domain, string $projectName, array $filters = [], ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/members', [
            'domain' => $domain,
            'project_name' => $projectName,
        ], $filters);
    }

    public function addProjectMember(string $domain, string $projectName, int $userId, int $permissionId, ?string $accessToken = null): BuddyResponse
    {
        return $this->postJson($accessToken, [
            'id' => $userId,
            'permission_set' => [
                'id' => $permissionId,
            ],
        ], '/workspaces/:domain/projects/:project_name/members', [
            'domain' => $domain,
            'project_name' => $projectName,
        ]);
    }

    public function getProjectMember(string $domain, string $projectName, int $userId, ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/members/:member_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'member_id' => $userId,
        ]);
    }

    public function editProjectMember(string $domain, string $projectName, int $userId, int $permissionId, ?string $accessToken = null): BuddyResponse
    {
        return $this->patchJson($accessToken, [
            'permission_set' => [
                'id' => $permissionId,
            ],
        ], '/workspaces/:domain/projects/:project_name/members/:member_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'member_id' => $userId,
        ]);
    }

    public function deleteProjectMember(string $domain, string $projectName, int $userId, ?string $accessToken = null): BuddyResponse
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/projects/:project_name/members/:member_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'member_id' => $userId,
        ]);
    }
}
