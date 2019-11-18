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

namespace Buddy;

use Buddy\Apis\Branches;
use Buddy\Apis\Commits;
use Buddy\Apis\Emails;
use Buddy\Apis\Executions;
use Buddy\Apis\Groups;
use Buddy\Apis\Integrations;
use Buddy\Apis\Members;
use Buddy\Apis\Permissions;
use Buddy\Apis\Pipelines;
use Buddy\Apis\Profile;
use Buddy\Apis\Projects;
use Buddy\Apis\Source;
use Buddy\Apis\SshKeys;
use Buddy\Apis\Tags;
use Buddy\Apis\Webhooks;
use Buddy\Apis\Workspaces;

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
     * @var Apis\Executions
     */
    private $apiExecutions;

    /**
     * @var Apis\Pipelines
     */
    private $apiPipelines;

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
     * @var Apis\Integrations
     */
    private $apiIntegrations;

    /**
     * Buddy constructor.
     */
    public function __construct(array $config = [])
    {
        $this->client = new BuddyClient();
        $this->oauth = new BuddyOAuth($this->client, $config);
        $this->apiWorkspaces = new Workspaces($this->client, $config);
        $this->apiProjects = new Projects($this->client, $config);
        $this->apiMembers = new Members($this->client, $config);
        $this->apiPermissions = new Permissions($this->client, $config);
        $this->apiGroups = new Groups($this->client, $config);
        $this->apiWebhooks = new Webhooks($this->client, $config);
        $this->apiBranches = new Branches($this->client, $config);
        $this->apiCommits = new Commits($this->client, $config);
        $this->apiEmails = new Emails($this->client, $config);
        $this->apiProfile = new Profile($this->client, $config);
        $this->apiExecutions = new Executions($this->client, $config);
        $this->apiPipelines = new Pipelines($this->client, $config);
        $this->apiSource = new Source($this->client, $config);
        $this->apiSshKeys = new SshKeys($this->client, $config);
        $this->apiTags = new Tags($this->client, $config);
        $this->apiIntegrations = new Integrations($this->client, $config);
    }

    /**
     * @return Apis\Integrations
     */
    public function getApiIntegrations(): Integrations
    {
        return $this->apiIntegrations;
    }

    /**
     * @return Apis\Tags
     */
    public function getApiTags(): Tags
    {
        return $this->apiTags;
    }

    /**
     * @return Apis\SshKeys
     */
    public function getApiSshKeys(): SshKeys
    {
        return $this->apiSshKeys;
    }

    /**
     * @return Apis\Source
     */
    public function getApiSource(): Source
    {
        return $this->apiSource;
    }

    /**
     * @return Apis\Pipelines
     */
    public function getApiPipelines(): Pipelines
    {
        return $this->apiPipelines;
    }

    /**
     * @return Apis\Executions
     */
    public function getApiExecutions(): Executions
    {
        return $this->apiExecutions;
    }

    /**
     * @return Apis\Profile
     */
    public function getApiProfile(): Profile
    {
        return $this->apiProfile;
    }

    /**
     * @return Apis\Emails
     */
    public function getApiEmails(): Emails
    {
        return $this->apiEmails;
    }

    /**
     * @return Apis\Commits
     */
    public function getApiCommits(): Commits
    {
        return $this->apiCommits;
    }

    /**
     * @return Apis\Branches
     */
    public function getApiBranches(): Branches
    {
        return $this->apiBranches;
    }

    /**
     * @return Apis\Webhooks
     */
    public function getApiWebhooks(): Webhooks
    {
        return $this->apiWebhooks;
    }

    /**
     * @return Apis\Groups
     */
    public function getApiGroups(): Groups
    {
        return $this->apiGroups;
    }

    /**
     * @return Apis\Permissions
     */
    public function getApiPermissions(): Permissions
    {
        return $this->apiPermissions;
    }

    /**
     * @return Apis\Members
     */
    public function getApiMembers(): Members
    {
        return $this->apiMembers;
    }

    /**
     * @return Apis\Workspaces
     */
    public function getApiWorkspaces(): Workspaces
    {
        return $this->apiWorkspaces;
    }

    /**
     * @return Apis\Projects
     */
    public function getApiProjects(): Projects
    {
        return $this->apiProjects;
    }

    public function getOAuth(): BuddyOAuth
    {
        return $this->oauth;
    }
}
