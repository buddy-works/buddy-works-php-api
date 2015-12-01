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
use Buddy\Objects\Branch;
use Buddy\Objects\Commit;

class Branches extends Api
{
    /**
     * @param string $domain
     * @param string $projectName
     * @param null|string $accessToken
     * @return \Buddy\Objects\Branches
     */
    public function getBranches($domain, $projectName, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/repository/branches', [
           'domain' => $domain,
            'project_name' => $projectName
        ])->getAsBranches();
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param string $name
     * @param null|string $accessToken
     * @return \Buddy\Objects\Branch
     */
    public function getBranch($domain, $projectName, $name, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/repository/branches/:name', [
            'domain' => $domain,
            'project_name' => $projectName,
            'name' => $name
        ])->getAsBranch();
    }

    /**
     * @param Branch $branch
     * @param string $domain
     * @param string $projectName
     * @param null|string $accessToken
     * @return Branch
     * @throws BuddySDKException
     */
    public function addBranch(Branch $branch, $domain, $projectName, $accessToken = null)
    {
        if (!($branch->getCommit() instanceof Commit)) {
            throw new BuddySDKException('Commit with revision must be provided');
        }
        return $this->postJson($accessToken, [
            'name' => $branch->getName(),
            'commit' => [
                'revision' => $branch->getCommit()->getRevision()
            ]
        ], '/workspaces/:domain/projects/:project_name/repository/branches', [
            'domain' => $domain,
            'project_name' => $projectName
        ])->getAsBranch();
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param string $name
     * @param bool|false $force
     * @param null|string $accessToken
     * @return bool
     */
    public function deleteBranch($domain, $projectName, $name, $force = false, $accessToken = null)
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/projects/:project_name/repository/branches/:name', [
            'domain' => $domain,
            'project_name' => $projectName,
            'name' => $name
        ], [
            'force' => $force
        ])->getAsBool();
    }
}
