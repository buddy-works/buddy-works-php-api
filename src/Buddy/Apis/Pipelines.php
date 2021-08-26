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

class Pipelines extends Api
{
    public const PIPELINE_TRIGGER_MODE_MANUAL = 'MANUAL';
    public const PIPELINE_TRIGGER_MODE_SCHEDULED = 'SCHEDULED';
    public const PIPELINE_TRIGGER_MODE_ON_EVERY_PUSH = 'ON_EVERY_PUSH';

    public const ACTION_TRIGGER_TIME_ON_EVERY_EXECUTION = 'ON_EVERY_EXECUTION';
    public const ACTION_TRIGGER_TIME_ON_FAILURE = 'ON_FAILURE';
    public const ACTION_TRIGGER_TIME_ON_BACK_TO_SUCCESS = 'ON_BACK_TO_SUCCESS';

    public const ACTION_TYPE_BUILD = 'BUILD';
    public const ACTION_TYPE_ELASTIC_BEANSTALK = 'ELASTIC_BEANSTALK';
    public const ACTION_TYPE_CODE_DEPLOY = 'CODE_DEPLOY';
    public const ACTION_TYPE_EMAIL = 'EMAIL';
    public const ACTION_TYPE_FTP = 'FTP';
    public const ACTION_TYPE_FTPS = 'FTPS';
    public const ACTION_TYPE_HEROKU = 'HEROKU';
    public const ACTION_TYPE_HEROKU_CLI = 'HEROKU_CLI';
    public const ACTION_TYPE_HTTP = 'HTTP';
    public const ACTION_TYPE_PING = 'PING';
    public const ACTION_TYPE_PUSH = 'PUSH';
    public const ACTION_TYPE_RUN_NEXT_PIPELINE = 'RUN_NEXT_PIPELINE';
    public const ACTION_TYPE_AMAZON_S3 = 'AMAZON_S3';
    public const ACTION_TYPE_SFTP = 'SFTP';
    public const ACTION_TYPE_DIGITAL_OCEAN = 'DIGITAL_OCEAN';
    public const ACTION_TYPE_GCE = 'GCE';
    public const ACTION_TYPE_SLACK = 'SLACK';
    public const ACTION_TYPE_SMS = 'SMS';
    public const ACTION_TYPE_SSH_COMMAND = 'SSH_COMMAND';
    public const ACTION_TYPE_TCP = 'TCP';
    public const ACTION_TYPE_WEB = 'WEB';
    public const ACTION_TYPE_WEB_DAV = 'WEB_DAV';
    public const ACTION_TYPE_PUSHOVER = 'PUSHOVER';
    public const ACTION_TYPE_PUSHBULLET = 'PUSHBULLET';
    public const ACTION_TYPE_SHOPIFY = 'SHOPIFY';
    public const ACTION_TYPE_AZURE = 'AZURE';
    public const ACTION_TYPE_DOCKERFILE = 'DOCKERFILE';
    public const ACTION_TYPE_LAMBDA = 'LAMBDA';
    public const ACTION_TYPE_AWS_LAMBDA_DEPLOY = 'AWS_LAMBDA_DEPLOY';
    public const ACTION_TYPE_GCS = 'GCS';
    public const ACTION_TYPE_GOOGLE_APP_ENGINE = 'GOOGLE_APP_ENGINE';
    public const ACTION_TYPE_RACKSPACE = 'RACKSPACE';
    public const ACTION_TYPE_CLOUDFLARE = 'CLOUDFLARE';
    public const ACTION_TYPE_RSYNC = 'RSYNC';
    public const ACTION_TYPE_CLOUD_FRONT = 'CLOUD_FRONT';
    public const ACTION_TYPE_MONITOR = 'MONITOR';
    public const ACTION_TYPE_AWS_CLI = 'AWS_CLI';
    public const ACTION_TYPE_SLEEP = 'SLEEP';
    public const ACTION_TYPE_GOOGLE_CDN = 'GOOGLE_CDN';
    public const ACTION_TYPE_KUBERNETES_APPLY = 'KUBERNETES_APPLY';
    public const ACTION_TYPE_KUBERNETES_SET_IMAGE = 'KUBERNETES_SET_IMAGE';
    public const ACTION_TYPE_KUBERNETES_RUN_POD = 'KUBERNETES_RUN_POD';
    public const ACTION_TYPE_NEW_RELIC = 'NEW_RELIC';
    public const ACTION_TYPE_GKE_APPLY = 'GKE_APPLY';
    public const ACTION_TYPE_GKE_SET_IMAGE = 'GKE_SET_IMAGE';
    public const ACTION_TYPE_GKE_RUN_POD = 'GKE_RUN_POD';
    public const ACTION_TYPE_GKE_RUN_JOB = 'GKE_RUN_JOB';
    public const ACTION_TYPE_WAIT_FOR_APPLY = 'WAIT_FOR_APPLY';
    public const ACTION_TYPE_ZIP = 'ZIP';

    public const ACTION_INPUT_TYPE_SCM_REPOSITORY = 'SCM_REPOSITORY';
    public const ACTION_INPUT_TYPE_BUILD_ARTIFACTS = 'BUILD_ARTIFACTS';

    public const ACTION_AUTH_MODE_PASS = 'PASS';
    public const ACTION_AUTH_MODE_PRIVATE_KEY = 'PRIVATE_KEY';
    public const ACTION_AUTH_MODE_PRIVATE_KEY_AND_PASS = 'PRIVATE_KEY_AND_PASS';

    public const SERVICE_TYPE_MYSQL = 'MYSQL';
    public const SERVICE_TYPE_MONGO_DB = 'MONGO_DB';
    public const SERVICE_TYPE_MARIADB = 'MARIADB';
    public const SERVICE_TYPE_POSTGRE_SQL = 'POSTGRE_SQL';
    public const SERVICE_TYPE_REDIS = 'REDIS';
    public const SERVICE_TYPE_MEMCACHED = 'MEMCACHED';
    public const SERVICE_TYPE_ELASTICSEARCH = 'ELASTICSEARCH';

    /**
     * @param mixed[] $filters
     */
    public function getPipelines(string $domain, string $projectName, array $filters = [], ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/pipelines', [
            'domain' => $domain,
            'project_name' => $projectName,
        ], $filters);
    }

    /**
     * @param mixed[] $data
     */
    public function addPipeline(array $data, string $domain, string $projectName, ?string $accessToken = null): BuddyResponse
    {
        return $this->postJson($accessToken, $data, '/workspaces/:domain/projects/:project_name/pipelines', [
            'domain' => $domain,
            'project_name' => $projectName,
        ]);
    }

    public function getPipeline(string $domain, string $projectName, int $pipelineId, ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/pipelines/:pipeline_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'pipeline_id' => $pipelineId,
        ]);
    }

    /**
     * @param mixed[] $data
     */
    public function editPipeline(array $data, string $domain, string $projectName, int $pipelineId, ?string $accessToken = null): BuddyResponse
    {
        return $this->patchJson($accessToken, $data, '/workspaces/:domain/projects/:project_name/pipelines/:pipeline_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'pipeline_id' => $pipelineId,
        ]);
    }

    public function deletePipeline(string $domain, string $projectName, int $pipelineId, ?string $accessToken = null): BuddyResponse
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/projects/:project_name/pipelines/:pipeline_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'pipeline_id' => $pipelineId,
        ]);
    }

    public function getPipelineActions(string $domain, string $projectName, int $pipelineId, ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/pipelines/:pipeline_id/actions', [
            'domain' => $domain,
            'project_name' => $projectName,
            'pipeline_id' => $pipelineId,
        ]);
    }

    /**
     * @param mixed[] $data
     */
    public function addPipelineAction(array $data, string $domain, string $projectName, int $pipelineId, ?string $accessToken = null): BuddyResponse
    {
        return $this->postJson($accessToken, $data, '/workspaces/:domain/projects/:project_name/pipelines/:pipeline_id/actions', [
            'domain' => $domain,
            'project_name' => $projectName,
            'pipeline_id' => $pipelineId,
        ]);
    }

    public function getPipelineAction(string $domain, string $projectName, int $pipelineId, int $actionId, ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/pipelines/:pipeline_id/actions/:action_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'pipeline_id' => $pipelineId,
            'action_id' => $actionId,
        ]);
    }

    /**
     * @param mixed[] $data
     */
    public function editPipelineAction(array $data, string $domain, string $projectName, int $pipelineId, int $actionId, ?string $accessToken = null): BuddyResponse
    {
        return $this->patchJson($accessToken, $data, '/workspaces/:domain/projects/:project_name/pipelines/:pipeline_id/actions/:action_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'pipeline_id' => $pipelineId,
            'action_id' => $actionId,
        ]);
    }

    public function deletePipelineAction(string $domain, string $projectName, int $pipelineId, int $actionId, ?string $accessToken = null): BuddyResponse
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/projects/:project_name/pipelines/:pipeline_id/actions/:action_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'pipeline_id' => $pipelineId,
            'action_id' => $actionId,
        ]);
    }
}
