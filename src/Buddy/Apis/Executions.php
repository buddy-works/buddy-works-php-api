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

class Executions extends Api
{
    const STATUS_SUCCESSFUL = 'SUCCESSFUL';
    const STATUS_FAILED = 'FAILED';
    const STATUS_INPROGRESS = 'INPROGRESS';
    const STATUS_ENQUEUED = 'ENQUEUED';
    const STATUS_SKIPPED = 'SKIPPED';
    const STATUS_TERMINATED = 'TERMINATED';
    const STATUS_INITIAL = 'INITIAL';

    const OPERATION_RETRY = 'RETRY';
    const OPERATION_CANCEL = 'CANCEL';

    /**
     * @param string $domain
     * @param string $projectName
     * @param int $pipelineId
     * @param array $filters
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function getExecutions($domain, $projectName, $pipelineId, array $filters = [], $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/pipelines/:pipeline_id/executions', [
            'domain' => $domain,
            'project_name' => $projectName,
            'pipeline_id' => $pipelineId
        ], $filters);
    }

    /**
     * @param array $data
     * @param string $domain
     * @param string $projectName
     * @param int $pipelineId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function runExecution($data, $domain, $projectName, $pipelineId, $accessToken = null)
    {
        return $this->postJson($accessToken, $data, '/workspaces/:domain/projects/:project_name/pipelines/:pipeline_id/executions', [
            'domain' => $domain,
            'project_name' => $projectName,
            'pipeline_id' => $pipelineId
        ]);
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param int $pipelineId
     * @param int $executionId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function getExecution($domain, $projectName, $pipelineId, $executionId, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/pipelines/:pipeline_id/executions/:execution_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'pipeline_id' => $pipelineId,
            'execution_id' => $executionId
        ]);
    }

    /**
     * @param string $operation
     * @param string $domain
     * @param string $projectName
     * @param int $pipelineId
     * @param int $executionId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    private function cancelOrRetry($operation, $domain, $projectName, $pipelineId, $executionId, $accessToken = null)
    {
        return $this->patchJson($accessToken, [
            'operation' => $operation
        ], '/workspaces/:domain/projects/:project_name/pipelines/:pipeline_id/executions/:execution_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'pipeline_id' => $pipelineId,
            'execution_id' => $executionId
        ]);
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param int $pipelineId
     * @param int $executionId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function cancelExecution($domain, $projectName, $pipelineId, $executionId, $accessToken = null)
    {
        return $this->cancelOrRetry(self::OPERATION_CANCEL, $domain, $projectName, $pipelineId, $executionId, $accessToken);
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param int $pipelineId
     * @param int $executionId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function retryRelease($domain, $projectName, $pipelineId, $executionId, $accessToken = null)
    {
        return $this->cancelOrRetry(self::OPERATION_RETRY, $domain, $projectName, $pipelineId, $executionId, $accessToken);
    }
}
