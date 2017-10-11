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

class Webhooks extends Api
{
    const EVENT_PUSH = 'PUSH';
    const EVENT_EXECUTION_STARTED = 'EXECUTION_STARTED';
    const EVENT_EXECUTION_SUCCESSFUL = 'EXECUTION_SUCCESSFUL';
    const EVENT_EXECUTION_FAILED = 'EXECUTION_FAILED';
    const EVENT_EXECUTION_FINISHED = 'EXECUTION_FINISHED';

    /**
     * @param string $domain
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function getWebhooks($domain, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/webhooks', [
            'domain' => $domain
        ]);
    }

    /**
     * @param array $data
     * @param string $domain
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function addWebhook($data, $domain, $accessToken = null)
    {
        return $this->postJson($accessToken, $data, '/workspaces/:domain/webhooks', [
            'domain' => $domain
        ]);
    }

    /**
     * @param string $domain
     * @param int $webhookId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function getWebhook($domain, $webhookId, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/webhooks/:webhook_id', [
            'domain' => $domain,
            'webhook_id' => $webhookId
        ]);
    }

    /**
     * @param array $data
     * @param string $domain
     * @param int $webhookId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function editWebhook($data, $domain, $webhookId, $accessToken = null)
    {
        return $this->patchJson($accessToken, $data, '/workspaces/:domain/webhooks/:webhook_id', [
            'domain' => $domain,
            'webhook_id' => $webhookId
        ]);
    }

    /**
     * @param string $domain
     * @param int $webhookId
     * @param null|string $accessToken
     * @return \Buddy\BuddyResponse
     */
    public function deleteWebhook($domain, $webhookId, $accessToken = null)
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/webhooks/:webhook_id', [
            'domain' => $domain,
            'webhook_id' => $webhookId
        ]);
    }
}
