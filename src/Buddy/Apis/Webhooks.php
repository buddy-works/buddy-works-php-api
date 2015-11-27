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

use Buddy\Objects\Project;
use Buddy\Objects\Webhook;

class Webhooks extends Api
{
    /**
     * @param string $domain
     * @param null|string $accessToken
     * @return \Buddy\Objects\Webhooks
     */
    public function getWebhooks($domain, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/webhooks', [
            'domain' => $domain
        ])->getAsWebhooks();
    }

    /**
     * @param Webhook $webhook
     * @param string $domain
     * @param null|string $accessToken
     * @return Webhook
     */
    public function addWebhook(Webhook $webhook, $domain, $accessToken = null)
    {
        $data = [
            'target_url' => $webhook->getTargetUrl(),
            'secret_key' => $webhook->getSecretKey(),
            'events' => $webhook->getEvents()
        ];
        $projectFilter = $webhook->getProjectFilter();
        if ($projectFilter instanceof Project) {
            $data['project_filter'] = [
                'name' => $projectFilter->getName()
            ];
        }
        return $this->postJson($accessToken, $data, '/workspaces/:domain/webhooks', [
            'domain' => $domain
        ])->getAsWebhook();
    }

    /**
     * @param string $domain
     * @param int $webhookId
     * @param null|string $accessToken
     * @return Webhook
     */
    public function getWebhook($domain, $webhookId, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/webhooks/:webhook_id', [
            'domain' => $domain,
            'webhook_id' => $webhookId
        ])->getAsWebhook();
    }

    /**
     * @param Webhook $webhook
     * @param string $domain
     * @param int $webhookId
     * @param null|string $accessToken
     * @return Webhook
     */
    public function editWebhook(Webhook $webhook, $domain, $webhookId, $accessToken = null)
    {
        $data = [
            'target_url' => $webhook->getTargetUrl(),
            'secret_key' => $webhook->getSecretKey(),
            'events' => $webhook->getEvents()
        ];
        $projectFilter = $webhook->getProjectFilter();
        if (isset($projectFilter)) {
            $data['project_filter'] = [
                'name' => $projectFilter->getName()
            ];
        }
        return $this->patchJson($accessToken, $data, '/workspaces/:domain/webhooks/:webhook_id', [
            'domain' => $domain,
            'webhook_id' => $webhookId
        ])->getAsWebhook();
    }

    /**
     * @param string $domain
     * @param int $webhookId
     * @param null|string $accessToken
     * @return bool
     */
    public function deleteWebhook($domain, $webhookId, $accessToken = null)
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/webhooks/:webhook_id', [
            'domain' => $domain,
            'webhook_id' => $webhookId
        ])->getAsBool();
    }
}
