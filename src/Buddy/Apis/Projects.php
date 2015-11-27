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

use Buddy\Exceptions\BuddySDKException;
use Buddy\Objects\PermissionSet;
use Buddy\Objects\Project;
use Buddy\Objects\User;

class Projects extends Api
{
    /**
     * @param string $domain
     * @param array $filters
     * @param null|string $accessToken
     * @return \Buddy\Objects\Projects
     */
    public function getProjects($domain, array $filters = [], $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects', [
            'domain' => $domain
        ], $filters)->getAsProjects();
    }

    /**
     * @param Project $project
     * @param string $domain
     * @param null|string $accessToken
     * @return Project
     */
    public function addProject(Project $project, $domain, $accessToken = null)
    {
        return $this->postJson($accessToken, [
            'name' => $project->getName(),
            'display_name' => $project->getDisplayName()

        ], '/workspaces/:domain/projects', [
            'domain' => $domain

        ])->getAsProject();
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param null|string $accessToken
     * @return Project
     */
    public function getProject($domain, $projectName, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name', [
            'domain' => $domain,
            'project_name' => $projectName
        ])->getAsProject();
    }

    /**
     * @param Project $project
     * @param string $domain
     * @param string $projectName
     * @param null|string $accessToken
     * @return Project
     */
    public function editProject(Project $project, $domain, $projectName, $accessToken = null)
    {
        return $this->patchJson($accessToken, [
            'name' => $project->getName(),
            'display_name' => $project->getDisplayName()
        ], '/workspaces/:domain/projects/:project_name', [
            'domain' => $domain,
            'project_name' => $projectName
        ])->getAsProject();
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param null|string $accessToken
     * @return bool
     */
    public function deleteProject($domain, $projectName, $accessToken = null)
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/projects/:project_name', [
            'domain' => $domain,
            'project_name' => $projectName
        ])->getAsBool();
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param array $filters
     * @param null|string $accessToken
     * @return \Buddy\Objects\Members
     */
    public function getProjectMembers($domain, $projectName, array $filters = [], $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/members', [
            'domain' => $domain,
            'project_name' => $projectName
        ], $filters)->getAsMembers();
    }

    /**
     * @param User $user
     * @param string $domain
     * @param string $projectName
     * @param null|string $accessToken
     * @return User
     * @throws BuddySDKException
     */
    public function addProjectMember(User $user, $domain, $projectName, $accessToken = null)
    {
        if (!($user->getPermissionSet() instanceof PermissionSet)) {
            throw new BuddySDKException('PermissionSet must be set');
        }
        return $this->postJson($accessToken, [
            'id' => $user->getId(),
            'permission_set' => [
                'id' => $user->getPermissionSet()->getId()
            ]
        ], '/workspaces/:domain/projects/:project_name/members', [
            'domain' => $domain,
            'project_name' => $projectName
        ])->getAsUser();
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param int $memberId
     * @param null|string $accessToken
     * @return User
     */
    public function getProjectMember($domain, $projectName, $memberId, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/members/:member_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'member_id' => $memberId
        ])->getAsUser();
    }

    /**
     * @param User $user
     * @param string $domain
     * @param string $projectName
     * @param int $memberId
     * @param null|string $accessToken
     * @return User
     * @throws BuddySDKException
     */
    public function editProjectMember(User $user, $domain, $projectName, $memberId, $accessToken = null)
    {
        if (!($user->getPermissionSet() instanceof PermissionSet)) {
            throw new BuddySDKException('PermissionSet must be set');
        }
        return $this->patchJson($accessToken, [
            'permission_set' => [
                'id' => $user->getPermissionSet()->getId()
            ]
        ], '/workspaces/:domain/projects/:project_name/members/:member_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'member_id' => $memberId
        ])->getAsUser();
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param int $memberId
     * @param null|string $accessToken
     * @return bool
     */
    public function deleteProjectMember($domain, $projectName, $memberId, $accessToken = null)
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/projects/:project_name/members/:member_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'member_id' => $memberId
        ])->getAsBool();
    }
}
