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
     * @var Apis\Branches
     */
    private $apiBranches;

    /**
     * @var Apis\Commits
     */
    private $apiCommits;

    /**
     * @var Apis\Emails
     */
    private $apiEmails;

    /**
     * @var Apis\Profile
     */
    private $apiProfile;

    /**
     * @var Apis\Releases
     */
    private $apiReleases;

    /**
     * @var Apis\Scenarios
     */
    private $apiScenarios;

    /**
     * @var Apis\Source
     */
    private $apiSource;

    /**
     * @var Apis\SshKeys
     */
    private $apiSshKeys;

    /**
     * @var Apis\Tags
     */
    private $apiTags;

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
        $this->apiBranches = new Apis\Branches($this->client, $config);
        $this->apiCommits = new Apis\Commits($this->client, $config);
        $this->apiEmails = new Apis\Emails($this->client, $config);
        $this->apiProfile = new Apis\Profile($this->client, $config);
        $this->apiReleases = new Apis\Releases($this->client, $config);
        $this->apiScenarios = new Apis\Scenarios($this->client, $config);
        $this->apiSource = new Apis\Source($this->client, $config);
        $this->apiSshKeys = new Apis\SshKeys($this->client, $config);
        $this->apiTags = new Apis\Tags($this->client, $config);
    }

    /**
     * @return Apis\Tags
     */
    public function getApiTags()
    {
        return $this->apiTags;
    }

    /**
     * @return Apis\SshKeys
     */
    public function getApiSshKeys()
    {
        return $this->apiSshKeys;
    }

    /**
     * @return Apis\Source
     */
    public function getApiSource()
    {
        return $this->apiSource;
    }

    /**
     * @return Apis\Scenarios
     */
    public function getApiScenarios()
    {
        return $this->apiScenarios;
    }

    /**
     * @return Apis\Releases
     */
    public function getApiReleases()
    {
        return $this->apiReleases;
    }

    /**
     * @return Apis\Profile
     */
    public function getApiProfile()
    {
        return $this->apiProfile;
    }

    /**
     * @return Apis\Emails
     */
    public function getApiEmails()
    {
        return $this->apiEmails;
    }

    /**
     * @return Apis\Commits
     */
    public function getApiCommits()
    {
        return $this->apiCommits;
    }

    /**
     * @return Apis\Branches
     */
    public function getApiBranches()
    {
        return $this->apiBranches;
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
