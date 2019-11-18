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

class Source extends Api
{
    /**
     * @param string      $domain
     * @param string      $projectName
     * @param string      $path
     * @param string|null $accessToken
     *
     * @return \Buddy\BuddyResponse
     */
    public function getContents($domain, $projectName, $path = '/', array $filters = [], $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/repository/contents', [
            'domain' => $domain,
            'project_name' => $projectName,
        ], $filters, $path);
    }

    /**
     * @param array       $data
     * @param string      $domain
     * @param string      $projectName
     * @param string|null $accessToken
     *
     * @return \Buddy\BuddyResponse
     */
    public function addFile($data, $domain, $projectName, $accessToken = null)
    {
        return $this->postJson($accessToken, $data, '/workspaces/:domain/projects/:project_name/repository/contents', [
            'domain' => $domain,
            'project_name' => $projectName,
        ]);
    }

    /**
     * @param array       $data
     * @param string      $domain
     * @param string      $projectName
     * @param string      $path
     * @param string|null $accessToken
     *
     * @return \Buddy\BuddyResponse
     */
    public function editFile($data, $domain, $projectName, $path, $accessToken = null)
    {
        return $this->putJson($accessToken, $data, '/workspaces/:domain/projects/:project_name/repository/contents', [
            'domain' => $domain,
            'project_name' => $projectName,
        ], [], $path);
    }

    /**
     * @param array       $data
     * @param string      $domain
     * @param string      $projectName
     * @param string      $path
     * @param string|null $accessToken
     *
     * @return \Buddy\BuddyResponse
     */
    public function deleteFile($data, $domain, $projectName, $path, $accessToken = null)
    {
        return $this->deleteJson($accessToken, $data, '/workspaces/:domain/projects/:project_name/repository/contents', [
            'domain' => $domain,
            'project_name' => $projectName,
        ], [], $path);
    }
}
