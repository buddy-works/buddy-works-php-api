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

use Buddy\Objects\SourceContent;

class Source extends Api
{
    /**
     * @param string $domain
     * @param string $projectName
     * @param string $path
     * @param array $filters
     * @param null|string $accessToken
     * @return \Buddy\Objects\SourceContents
     */
    public function getContents($domain, $projectName, $path = '/', array $filters = [], $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/repository/contents', [
            'domain' => $domain,
            'project_name' => $projectName
        ], $filters, $path)->getAsSourceContents();
    }

    /**
     * @param SourceContent $content
     * @param string $domain
     * @param string $projectName
     * @param null|string $accessToken
     * @return \Buddy\Objects\SourceCommitContent
     */
    public function addFile(SourceContent $content, $domain, $projectName, $accessToken = null)
    {
        return $this->postJson($accessToken, [
            'path' => $content->getPath(),
            'message' => $content->getMessage(),
            'content' => $content->getContent(),
            'branch' => $content->getBranch()
        ], '/workspaces/:domain/projects/:project_name/repository/contents', [
            'domain' => $domain,
            'project_name' => $projectName
        ])->getAsSourceCommitContent();
    }

    /**
     * @param SourceContent $content
     * @param string $domain
     * @param string $projectName
     * @param string $path
     * @param null|string $accessToken
     * @return \Buddy\Objects\SourceCommitContent
     */
    public function editFile(SourceContent $content, $domain, $projectName, $path, $accessToken = null)
    {
        return $this->putJson($accessToken, [
            'message' => $content->getMessage(),
            'content' => $content->getContent()
        ], '/workspaces/:domain/projects/:project_name/repository/contents', [
            'domain' => $domain,
            'project_name' => $projectName
        ], [], $path)->getAsSourceCommitContent();
    }

    /**
     * @param SourceContent $content
     * @param string $domain
     * @param string $projectName
     * @param string $path
     * @param null|string $accessToken
     * @return \Buddy\Objects\Commit
     */
    public function deleteFile(SourceContent $content, $domain, $projectName, $path, $accessToken = null)
    {
        return $this->deleteJson($accessToken, [
            'message' => $content->getMessage(),
            'branch' => $content->getBranch()
        ], '/workspaces/:domain/projects/:project_name/repository/contents', [
            'domain' => $domain,
            'project_name' => $projectName
        ], [], $path)->getAsCommit();
    }
}
