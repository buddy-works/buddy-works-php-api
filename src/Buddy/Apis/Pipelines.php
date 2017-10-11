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

class Pipelines extends Api
{
    const PIPELINE_TRIGGER_MODE_MANUAL = 'MANUAL';
    const PIPELINE_TRIGGER_MODE_SCHEDULED = 'SCHEDULED';
    const PIPELINE_TRIGGER_MODE_ON_EVERY_PUSH = 'ON_EVERY_PUSH';

    const ACTION_TRIGGER_TIME_ON_EVERY_EXECUTION = 'ON_EVERY_EXECUTION';
    const ACTION_TRIGGER_TIME_ON_FAILURE = 'ON_FAILURE';
    const ACTION_TRIGGER_TIME_ON_BACK_TO_SUCCESS = 'ON_BACK_TO_SUCCESS';

    const ACTION_TYPE_BUILD = 'BUILD';
    const ACTION_TYPE_ELASTIC_BEANSTALK = 'ELASTIC_BEANSTALK';
    const ACTION_TYPE_CODE_DEPLOY = 'CODE_DEPLOY';
    const ACTION_TYPE_EMAIL = 'EMAIL';
    const ACTION_TYPE_FTP = 'FTP';
    const ACTION_TYPE_FTPS = 'FTPS';
    const ACTION_TYPE_HEROKU = 'HEROKU';
    const ACTION_TYPE_HEROKU_CLI = 'HEROKU_CLI';
    const ACTION_TYPE_HTTP = 'HTTP';
    const ACTION_TYPE_PING = 'PING';
    const ACTION_TYPE_PUSH = 'PUSH';
    const ACTION_TYPE_RUN_NEXT_PIPELINE = 'RUN_NEXT_PIPELINE';
    const ACTION_TYPE_AMAZON_S3 = 'AMAZON_S3';
    const ACTION_TYPE_SFTP = 'SFTP';
    const ACTION_TYPE_DIGITAL_OCEAN = 'DIGITAL_OCEAN';
    const ACTION_TYPE_GCE = 'GCE';
    const ACTION_TYPE_SLACK = 'SLACK';
    const ACTION_TYPE_SMS = 'SMS';
    const ACTION_TYPE_SSH_COMMAND = 'SSH_COMMAND';
    const ACTION_TYPE_TCP = 'TCP';
    const ACTION_TYPE_WEB = 'WEB';
    const ACTION_TYPE_WEB_DAV = 'WEB_DAV';
    const ACTION_TYPE_PUSHOVER = 'PUSHOVER';
    const ACTION_TYPE_PUSHBULLET = 'PUSHBULLET';
    const ACTION_TYPE_SHOPIFY = 'SHOPIFY';
    const ACTION_TYPE_AZURE = 'AZURE';
    const ACTION_TYPE_DOCKERFILE = 'DOCKERFILE';
    const ACTION_TYPE_LAMBDA = 'LAMBDA';
    const ACTION_TYPE_AWS_LAMBDA_DEPLOY = 'AWS_LAMBDA_DEPLOY';
    const ACTION_TYPE_GCS = 'GCS';
    const ACTION_TYPE_GOOGLE_APP_ENGINE = 'GOOGLE_APP_ENGINE';
    const ACTION_TYPE_RACKSPACE = 'RACKSPACE';
    const ACTION_TYPE_CLOUDFLARE = 'CLOUDFLARE';
    const ACTION_TYPE_RSYNC = 'RSYNC';
    const ACTION_TYPE_CLOUD_FRONT = 'CLOUD_FRONT';
    const ACTION_TYPE_MONITOR = 'MONITOR';
    const ACTION_TYPE_AWS_CLI = 'AWS_CLI';
    const ACTION_TYPE_SLEEP = 'SLEEP';
    const ACTION_TYPE_GOOGLE_CDN = 'GOOGLE_CDN';
    const ACTION_TYPE_KUBERNETES_APPLY = 'KUBERNETES_APPLY';
    const ACTION_TYPE_KUBERNETES_SET_IMAGE = 'KUBERNETES_SET_IMAGE';
    const ACTION_TYPE_KUBERNETES_RUN_POD = 'KUBERNETES_RUN_POD';
    const ACTION_TYPE_NEW_RELIC = 'NEW_RELIC';
    const ACTION_TYPE_GKE_APPLY = 'GKE_APPLY';
    const ACTION_TYPE_GKE_SET_IMAGE = 'GKE_SET_IMAGE';
    const ACTION_TYPE_GKE_RUN_POD = 'GKE_RUN_POD';
    const ACTION_TYPE_GKE_RUN_JOB = 'GKE_RUN_JOB';
    const ACTION_TYPE_WAIT_FOR_APPLY = 'WAIT_FOR_APPLY';
    const ACTION_TYPE_ZIP = 'ZIP';

    const ACTION_INPUT_TYPE_SCM_REPOSITORY = 'SCM_REPOSITORY';
    const ACTION_INPUT_TYPE_BUILD_ARTIFACTS = 'BUILD_ARTIFACTS';

    const ACTION_AUTH_MODE_PASS = 'PASS';
    const ACTION_AUTH_MODE_PRIVATE_KEY = 'PRIVATE_KEY';
    const ACTION_AUTH_MODE_PRIVATE_KEY_AND_PASS = 'PRIVATE_KEY_AND_PASS';

    const SERVICE_TYPE_MYSQL = 'MYSQL';
    const SERVICE_TYPE_MONGO_DB = 'MONGO_DB';
    const SERVICE_TYPE_MARIADB = 'MARIADB';
    const SERVICE_TYPE_POSTGRE_SQL = 'POSTGRE_SQL';
    const SERVICE_TYPE_REDIS = 'REDIS';
    const SERVICE_TYPE_MEMCACHED = 'MEMCACHED';
    const SERVICE_TYPE_ELASTICSEARCH = 'ELASTICSEARCH';

    /**
     * @param string $domain
     * @param string $projectName
     * @param array $filters
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function getPipelines($domain, $projectName, array $filters = [], $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/release_scenarios', [
            'domain' => $domain,
            'project_name' => $projectName
        ], $filters);
    }

    /**
     * @param array $data
     * @param string $domain
     * @param string $projectName
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function addPipeline($data, $domain, $projectName, $accessToken = null)
    {
        return $this->postJson($accessToken, $data, '/workspaces/:domain/projects/:project_name/pipelines', [
            'domain' => $domain,
            'project_name' => $projectName
        ]);
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param int $pipelineId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function getPipeline($domain, $projectName, $pipelineId, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/pipelines/:pipeline_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'pipeline_id' => $pipelineId
        ]);
    }

    /**
     * @param array $data
     * @param string $domain
     * @param string $projectName
     * @param int $pipelineId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function editPipeline($data, $domain, $projectName, $pipelineId, $accessToken = null)
    {
        return $this->patchJson($accessToken, $data, '/workspaces/:domain/projects/:project_name/pipelines/:pipeline_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'pipeline_id' => $pipelineId
        ]);
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param int $pipelineId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function deletePipeline($domain, $projectName, $pipelineId, $accessToken = null)
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/projects/:project_name/pipelines/:pipeline_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'pipeline_id' => $pipelineId
        ]);
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param int $pipelineId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function getPipelineActions($domain, $projectName, $pipelineId, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/pipelines/:pipeline_id/actions', [
            'domain' => $domain,
            'project_name' => $projectName,
            'pipeline_id' => $pipelineId
        ]);
    }

    /**
     * @param array $data
     * @param string $domain
     * @param string $projectName
     * @param int $pipelineId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function addPipelineAction($data, $domain, $projectName, $pipelineId, $accessToken = null)
    {
        return $this->postJson($accessToken, $data, '/workspaces/:domain/projects/:project_name/pipelines/:pipeline_id/actions', [
            'domain' => $domain,
            'project_name' => $projectName,
            'pipeline_id' => $pipelineId
        ]);
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param int $pipelineId
     * @param int $actionId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function getPipelineAction($domain, $projectName, $pipelineId, $actionId, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/pipelines/:pipeline_id/actions/:action_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'pipeline_id' => $pipelineId,
            'action_id' => $actionId
        ]);
    }

    /**
     * @param array $data
     * @param string $domain
     * @param string $projectName
     * @param int $pipelineId
     * @param int $actionId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function editPipelineAction($data, $domain, $projectName, $pipelineId, $actionId, $accessToken = null)
    {
        return $this->patchJson($accessToken, $data, '/workspaces/:domain/projects/:project_name/pipelines/:pipeline_id/actions/:action_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'pipeline_id' => $pipelineId,
            'action_id' => $actionId
        ]);
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param int $pipelineId
     * @param int $actionId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function deletePipelineAction($domain, $projectName, $pipelineId, $actionId, $accessToken = null)
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/projects/:project_name/pipelines/:pipeline_id/actions/:action_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'pipeline_id' => $pipelineId,
            'action_id' => $actionId
        ]);
    }
}
