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

    public function getExecutions(string $domain, string $projectName, int $pipelineId, array $filters = [], ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/pipelines/:pipeline_id/executions', [
            'domain' => $domain,
            'project_name' => $projectName,
            'pipeline_id' => $pipelineId,
        ], $filters);
    }

    public function runExecution(array $data, string $domain, string $projectName, int $pipelineId, ?string $accessToken = null): BuddyResponse
    {
        return $this->postJson($accessToken, $data, '/workspaces/:domain/projects/:project_name/pipelines/:pipeline_id/executions', [
            'domain' => $domain,
            'project_name' => $projectName,
            'pipeline_id' => $pipelineId,
        ]);
    }

    public function getExecution(string $domain, string $projectName, int $pipelineId, int $executionId, ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/pipelines/:pipeline_id/executions/:execution_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'pipeline_id' => $pipelineId,
            'execution_id' => $executionId,
        ]);
    }

    private function cancelOrRetry(string $operation, string $domain, string $projectName, int $pipelineId, int $executionId, ?string $accessToken = null): BuddyResponse
    {
        return $this->patchJson($accessToken, [
            'operation' => $operation,
        ], '/workspaces/:domain/projects/:project_name/pipelines/:pipeline_id/executions/:execution_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'pipeline_id' => $pipelineId,
            'execution_id' => $executionId,
        ]);
    }

    public function cancelExecution(string $domain, string $projectName, int $pipelineId, int $executionId, ?string $accessToken = null): BuddyResponse
    {
        return $this->cancelOrRetry(self::OPERATION_CANCEL, $domain, $projectName, $pipelineId, $executionId, $accessToken);
    }

    public function retryRelease(string $domain, string $projectName, int $pipelineId, int $executionId, ?string $accessToken = null): BuddyResponse
    {
        return $this->cancelOrRetry(self::OPERATION_RETRY, $domain, $projectName, $pipelineId, $executionId, $accessToken);
    }
}
