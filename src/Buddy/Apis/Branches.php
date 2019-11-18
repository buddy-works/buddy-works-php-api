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

class Branches extends Api
{
    /**
     * @param string      $domain
     * @param string      $projectName
     * @param string|null $accessToken
     *
     * @return \Buddy\BuddyResponse
     */
    public function getBranches($domain, $projectName, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/repository/branches', [
           'domain' => $domain,
           'project_name' => $projectName,
        ]);
    }

    /**
     * @param string      $domain
     * @param string      $projectName
     * @param string      $name
     * @param string|null $accessToken
     *
     * @return \Buddy\BuddyResponse
     */
    public function getBranch($domain, $projectName, $name, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/repository/branches/:name', [
            'domain' => $domain,
            'project_name' => $projectName,
            'name' => $name,
        ]);
    }

    /**
     * @param array       $data
     * @param string      $domain
     * @param string      $projectName
     * @param string|null $accessToken
     *
     * @return \Buddy\BuddyResponse
     */
    public function addBranch($data, $domain, $projectName, $accessToken = null)
    {
        return $this->postJson($accessToken, $data, '/workspaces/:domain/projects/:project_name/repository/branches', [
            'domain' => $domain,
            'project_name' => $projectName,
        ]);
    }

    /**
     * @param string      $domain
     * @param string      $projectName
     * @param string      $name
     * @param bool|false  $force
     * @param string|null $accessToken
     *
     * @return \Buddy\BuddyResponse
     */
    public function deleteBranch($domain, $projectName, $name, $force = false, $accessToken = null)
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/projects/:project_name/repository/branches/:name', [
            'domain' => $domain,
            'project_name' => $projectName,
            'name' => $name,
        ], [
            'force' => $force,
        ]);
    }
}
