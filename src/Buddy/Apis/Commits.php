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

class Commits extends Api
{
    /**
     * @param string      $domain
     * @param string      $projectName
     * @param string|null $accessToken
     *
     * @return \Buddy\BuddyResponse
     */
    public function getCommits($domain, $projectName, array $filters = [], $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/repository/commits', [
            'domain' => $domain,
            'project_name' => $projectName,
        ], $filters);
    }

    /**
     * @param string      $domain
     * @param string      $projectName
     * @param string      $revision
     * @param string|null $accessToken
     *
     * @return \Buddy\BuddyResponse
     */
    public function getCommit($domain, $projectName, $revision, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/repository/commits/:revision', [
            'domain' => $domain,
            'project_name' => $projectName,
            'revision' => $revision,
        ]);
    }

    /**
     * @param string      $domain
     * @param string      $projectName
     * @param string      $base
     * @param string      $head
     * @param string|null $accessToken
     *
     * @return \Buddy\BuddyResponse
     */
    public function getCompare($domain, $projectName, $base, $head, array $filters = [], $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/repository/comparison/:base...:head', [
            'domain' => $domain,
            'project_name' => $projectName,
            'base' => $base,
            'head' => $head,
        ], $filters);
    }
}
