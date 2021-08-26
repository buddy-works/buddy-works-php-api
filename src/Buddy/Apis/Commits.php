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

class Commits extends Api
{
    /**
     * @param mixed[] $filters
     */
    public function getCommits(string $domain, string $projectName, array $filters = [], ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/repository/commits', [
            'domain' => $domain,
            'project_name' => $projectName,
        ], $filters);
    }

    public function getCommit(string $domain, string $projectName, string $revision, ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/repository/commits/:revision', [
            'domain' => $domain,
            'project_name' => $projectName,
            'revision' => $revision,
        ]);
    }

    /**
     * @param mixed[] $filters
     */
    public function getCompare(string $domain, string $projectName, string $base, string $head, array $filters = [], ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/repository/comparison/:base...:head', [
            'domain' => $domain,
            'project_name' => $projectName,
            'base' => $base,
            'head' => $head,
        ], $filters);
    }
}
