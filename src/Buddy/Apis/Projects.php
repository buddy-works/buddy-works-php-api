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

class Projects extends Api
{
    /**
     * @param string $domain
     * @param array $filters
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function getProjects($domain, array $filters = [], $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects', [
            'domain' => $domain
        ], $filters);
    }

    /**
     * @param array $data
     * @param string $domain
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function addProject($data, $domain, $accessToken = null)
    {
        return $this->postJson($accessToken, $data, '/workspaces/:domain/projects', [
            'domain' => $domain
        ]);
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function getProject($domain, $projectName, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name', [
            'domain' => $domain,
            'project_name' => $projectName
        ]);
    }

    /**
     * @param array $data
     * @param string $domain
     * @param string $projectName
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function editProject($data, $domain, $projectName, $accessToken = null)
    {
        return $this->patchJson($accessToken, $data, '/workspaces/:domain/projects/:project_name', [
            'domain' => $domain,
            'project_name' => $projectName
        ]);
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function deleteProject($domain, $projectName, $accessToken = null)
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/projects/:project_name', [
            'domain' => $domain,
            'project_name' => $projectName
        ]);
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param array $filters
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function getProjectMembers($domain, $projectName, array $filters = [], $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/members', [
            'domain' => $domain,
            'project_name' => $projectName
        ], $filters);
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param int $userId
     * @param int $permissionId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function addProjectMember($domain, $projectName, $userId, $permissionId, $accessToken = null)
    {
        return $this->postJson($accessToken, [
            'id' => $userId,
            'permission_set' => [
                'id' => $permissionId
            ]
        ], '/workspaces/:domain/projects/:project_name/members', [
            'domain' => $domain,
            'project_name' => $projectName
        ]);
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param int $userId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function getProjectMember($domain, $projectName, $userId, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/members/:member_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'member_id' => $userId
        ]);
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param int $userId
     * @param int $permissionId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function editProjectMember($domain, $projectName, $userId, $permissionId, $accessToken = null)
    {
        return $this->patchJson($accessToken, [
            'permission_set' => [
                'id' => $permissionId
            ]
        ], '/workspaces/:domain/projects/:project_name/members/:member_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'member_id' => $userId
        ]);
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param int $userId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function deleteProjectMember($domain, $projectName, $userId, $accessToken = null)
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/projects/:project_name/members/:member_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'member_id' => $userId
        ]);
    }
}
