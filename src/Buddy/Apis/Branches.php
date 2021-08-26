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

class Branches extends Api
{
    public function getBranches(string $domain, string $projectName, ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/repository/branches', [
           'domain' => $domain,
           'project_name' => $projectName,
        ]);
    }

    public function getBranch(string $domain, string $projectName, string $name, ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/repository/branches/:name', [
            'domain' => $domain,
            'project_name' => $projectName,
            'name' => $name,
        ]);
    }

    /**
     * @param mixed[] $data
     */
    public function addBranch(array $data, string $domain, string $projectName, ?string $accessToken = null): BuddyResponse
    {
        return $this->postJson($accessToken, $data, '/workspaces/:domain/projects/:project_name/repository/branches', [
            'domain' => $domain,
            'project_name' => $projectName,
        ]);
    }

    /**
     * @param bool|false $force
     */
    public function deleteBranch(string $domain, string $projectName, string $name, bool $force = false, ?string $accessToken = null): BuddyResponse
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
