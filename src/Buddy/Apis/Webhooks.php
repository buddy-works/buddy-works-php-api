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

class Webhooks extends Api
{
    public const EVENT_PUSH = 'PUSH';
    public const EVENT_EXECUTION_STARTED = 'EXECUTION_STARTED';
    public const EVENT_EXECUTION_SUCCESSFUL = 'EXECUTION_SUCCESSFUL';
    public const EVENT_EXECUTION_FAILED = 'EXECUTION_FAILED';
    public const EVENT_EXECUTION_FINISHED = 'EXECUTION_FINISHED';

    public function getWebhooks(string $domain, ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/webhooks', [
            'domain' => $domain,
        ]);
    }

    /**
     * @param mixed[] $data
     */
    public function addWebhook(array $data, string $domain, ?string $accessToken = null): BuddyResponse
    {
        return $this->postJson($accessToken, $data, '/workspaces/:domain/webhooks', [
            'domain' => $domain,
        ]);
    }

    public function getWebhook(string $domain, int $webhookId, ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/workspaces/:domain/webhooks/:webhook_id', [
            'domain' => $domain,
            'webhook_id' => $webhookId,
        ]);
    }

    /**
     * @param mixed[] $data
     */
    public function editWebhook(array $data, string $domain, int $webhookId, ?string $accessToken = null): BuddyResponse
    {
        return $this->patchJson($accessToken, $data, '/workspaces/:domain/webhooks/:webhook_id', [
            'domain' => $domain,
            'webhook_id' => $webhookId,
        ]);
    }

    public function deleteWebhook(string $domain, int $webhookId, ?string $accessToken = null): BuddyResponse
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/webhooks/:webhook_id', [
            'domain' => $domain,
            'webhook_id' => $webhookId,
        ]);
    }
}
