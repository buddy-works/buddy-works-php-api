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

class Source extends Api
{
    /**
     * @param mixed[] $filters
     */
    public function getContents(string $domain, string $projectName, string $path = '/', array $filters = [], ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/repository/contents', [
            'domain' => $domain,
            'project_name' => $projectName,
        ], $filters, $path);
    }

    /**
     * @param mixed[] $data
     */
    public function addFile(array $data, string $domain, string $projectName, ?string $accessToken = null): BuddyResponse
    {
        return $this->postJson($accessToken, $data, '/workspaces/:domain/projects/:project_name/repository/contents', [
            'domain' => $domain,
            'project_name' => $projectName,
        ]);
    }

    /**
     * @param mixed[] $data
     */
    public function editFile(array $data, string $domain, string $projectName, string $path, ?string $accessToken = null): BuddyResponse
    {
        return $this->putJson($accessToken, $data, '/workspaces/:domain/projects/:project_name/repository/contents', [
            'domain' => $domain,
            'project_name' => $projectName,
        ], [], $path);
    }

    /**
     * @param mixed[] $data
     */
    public function deleteFile(array $data, string $domain, string $projectName, string $path, ?string $accessToken = null): BuddyResponse
    {
        return $this->deleteJson($accessToken, $data, '/workspaces/:domain/projects/:project_name/repository/contents', [
            'domain' => $domain,
            'project_name' => $projectName,
        ], [], $path);
    }
}
