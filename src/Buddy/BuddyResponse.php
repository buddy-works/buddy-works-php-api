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

namespace Buddy;

use \Buddy\Objects;

class BuddyResponse
{
    /**
     * @var string
     */
    private $body;

    /**
     * @var array
     */
    private $headers;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * BuddyResponse constructor.
     * @param int $statusCode
     * @param array $headers
     * @param string $body
     */
    public function __construct($statusCode, $headers, $body)
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        $this->body = $body;
    }

    /**
     * @return Objects\Auth
     */
    public function getAsAuth()
    {
        return new Objects\Auth($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return Objects\Workspaces
     */
    public function getAsWorkspaces()
    {
        return new Objects\Workspaces($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return Objects\Workspace
     */
    public function getAsWorkspace()
    {
        return new Objects\Workspace($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return Objects\User
     */
    public function getAsUser()
    {
        return new Objects\User($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return Objects\Projects
     */
    public function getAsProjects()
    {
        return new Objects\Projects($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return Objects\Project
     */
    public function getAsProject()
    {
        return new Objects\Project($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return Objects\PermissionSet
     */
    public function getAsPermissionSet()
    {
        return new Objects\PermissionSet($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return Objects\PermissionSets
     */
    public function getAsPermissionSets()
    {
        return new Objects\PermissionSets($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return array
     */
    public function getBodyJson()
    {
        return json_decode($this->getBody(), true);
    }

    /**
     * @return Objects\Members
     */
    public function getAsMembers()
    {
        return new Objects\Members($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return Objects\Groups
     */
    public function getAsGroups()
    {
        return new Objects\Groups($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return Objects\Webhook
     */
    public function getAsWebhook()
    {
        return new Objects\Webhook($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return Objects\Webhooks
     */
    public function getAsWebhooks()
    {
        return new Objects\Webhooks($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return Objects\Group
     */
    public function getAsGroup()
    {
        return new Objects\Group($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return Objects\Commit
     */
    public function getAsCommit()
    {
        return new Objects\Commit($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return Objects\Commits
     */
    public function getAsCommits()
    {
        return new Objects\Commits($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return Objects\CompareCommits
     */
    public function getAsCompareCommits()
    {
        return new Objects\CompareCommits($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return Objects\SourceCommitContent
     */
    public function getAsSourceCommitContent()
    {
        return new Objects\SourceCommitContent($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return Objects\Branch
     */
    public function getAsBranch()
    {
        return new Objects\Branch($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return Objects\Branches
     */
    public function getAsBranches()
    {
        return new Objects\Branches($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return Objects\Email
     */
    public function getAsEmail()
    {
        return new Objects\Email($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return Objects\Emails
     */
    public function getAsEmails()
    {
        return new Objects\Emails($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return Objects\SshKeys
     */
    public function getAsSshKeys()
    {
        return new Objects\SshKeys($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return Objects\SshKey
     */
    public function getAsSshKey()
    {
        return new Objects\SshKey($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return Objects\Tag
     */
    public function getAsTag()
    {
        return new Objects\Tag($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return Objects\Tags
     */
    public function getAsTags()
    {
        return new Objects\Tags($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return Objects\SourceContents
     */
    public function getAsSourceContents()
    {
        return new Objects\SourceContents($this->getBodyJson(), $this->getHeaders(), $this->getStatusCode());
    }

    /**
     * @return bool
     */
    public function getAsBool()
    {
        return $this->getStatusCode() >= 200 && $this->getStatusCode() < 300;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
