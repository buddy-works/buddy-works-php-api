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

use Buddy\Apis;

class Buddy
{

    /**
     * @var BuddyClient
     */
    private $client;

    /**
     * @var BuddyOAuth
     */
    private $oauth;

    /**
     * @var Apis\Workspaces
     */
    private $apiWorkspaces;

    /**
     * @var Apis\Projects
     */
    private $apiProjects;

    /**
     * @var Apis\Members
     */
    private $apiMembers;

    /**
     * @var Apis\Permissions
     */
    private $apiPermissions;

    /**
     * @var Apis\Groups
     */
    private $apiGroups;

    /**
     * @var Apis\Webhooks
     */
    private $apiWebhooks;

    /**
     * Buddy constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->client = new BuddyClient();
        $this->oauth = new BuddyOAuth($this->client, $config);
        $this->apiWorkspaces = new Apis\Workspaces($this->client, $config);
        $this->apiProjects = new Apis\Projects($this->client, $config);
        $this->apiMembers = new Apis\Members($this->client, $config);
        $this->apiPermissions = new Apis\Permissions($this->client, $config);
        $this->apiGroups = new Apis\Groups($this->client, $config);
        $this->apiWebhooks = new Apis\Webhooks($this->client, $config);
    }

    /**
     * @return Apis\Webhooks
     */
    public function getApiWebhooks()
    {
        return $this->apiWebhooks;
    }

    /**
     * @return Apis\Groups
     */
    public function getApiGroups()
    {
        return $this->apiGroups;
    }

    /**
     * @return Apis\Permissions
     */
    public function getApiPermissions()
    {
        return $this->apiPermissions;
    }

    /**
     * @return Apis\Members
     */
    public function getApiMembers()
    {
        return $this->apiMembers;
    }

    /**
     * @return Apis\Workspaces
     */
    public function getApiWorkspaces()
    {
        return $this->apiWorkspaces;
    }

    /**
     * @return Apis\Projects
     */
    public function getApiProjects()
    {
        return $this->apiProjects;
    }

    /**
     * @return BuddyOAuth
     */
    public function getOAuth()
    {
        return $this->oauth;
    }
}
