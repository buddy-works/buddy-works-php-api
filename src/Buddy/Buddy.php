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
    private BuddyClient $client;
    private BuddyOAuth $oauth;
    private Workspaces $apiWorkspaces;
    private Projects $apiProjects;
    private Members $apiMembers;
    private Permissions $apiPermissions;
    private Groups $apiGroups;
    private Webhooks $apiWebhooks;
    private Branches $apiBranches;
    private Commits $apiCommits;
    private Emails $apiEmails;
    private Profile $apiProfile;
    private Executions $apiExecutions;
    private Pipelines $apiPipelines;
    private Source $apiSource;
    private SshKeys $apiSshKeys;
    private Tags $apiTags;
    private Integrations $apiIntegrations;

    /**
     * @param mixed[] $config
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

    public function getApiIntegrations(): Integrations
    {
        return $this->apiIntegrations;
    }

    public function getApiTags(): Tags
    {
        return $this->apiTags;
    }

    public function getApiSshKeys(): SshKeys
    {
        return $this->apiSshKeys;
    }

    public function getApiSource(): Source
    {
        return $this->apiSource;
    }

    public function getApiPipelines(): Pipelines
    {
        return $this->apiPipelines;
    }

    public function getApiExecutions(): Executions
    {
        return $this->apiExecutions;
    }

    public function getApiProfile(): Profile
    {
        return $this->apiProfile;
    }

    public function getApiEmails(): Emails
    {
        return $this->apiEmails;
    }

    public function getApiCommits(): Commits
    {
        return $this->apiCommits;
    }

    public function getApiBranches(): Branches
    {
        return $this->apiBranches;
    }

    public function getApiWebhooks(): Webhooks
    {
        return $this->apiWebhooks;
    }

    public function getApiGroups(): Groups
    {
        return $this->apiGroups;
    }

    public function getApiPermissions(): Permissions
    {
        return $this->apiPermissions;
    }

    public function getApiMembers(): Members
    {
        return $this->apiMembers;
    }

    public function getApiWorkspaces(): Workspaces
    {
        return $this->apiWorkspaces;
    }

    public function getApiProjects(): Projects
    {
        return $this->apiProjects;
    }

    public function getOAuth(): BuddyOAuth
    {
        return $this->oauth;
    }
}
