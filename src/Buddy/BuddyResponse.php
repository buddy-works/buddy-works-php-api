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
