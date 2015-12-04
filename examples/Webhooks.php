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

namespace Buddy\Examples;

use Buddy\Buddy;
use Buddy\Exceptions\BuddyResponseException;
use Buddy\Exceptions\BuddySDKException;
use Buddy\Objects\Webhook;

class Webhooks
{
    public function getWebhooks()
    {
        try {
            $buddy = new Buddy();
            $resp = $buddy->getApiWebhooks()->getWebhooks('domain', 'yourAccessToken');
            var_dump($resp->getWebhooks());
            exit;

        } catch (BuddyResponseException $e) {
            echo $e->getMessage();
            exit;

        } catch (BuddySDKException $e) {
            echo $e->getMessage();
            exit;

        }
    }

    public function addWebhook()
    {
        try {
            $buddy = new Buddy([
                'accessToken' => 'yourAccessToken'
            ]);
            $webhook = new Webhook();
            $webhook->setTargetUrl('http://test.com');
            $webhook->setSecretKey('test');
            $webhook->setEvents([Webhook::EVENT_PUSH]);
            $resp = $buddy->getApiWebhooks()->addWebhook($webhook, 'domain');
            var_dump($resp);
            exit;

        } catch (BuddyResponseException $e) {
            echo $e->getMessage();
            exit;

        } catch (BuddySDKException $e) {
            echo $e->getMessage();
            exit;

        }
    }

    public function getWebhook()
    {
        try {
            $buddy = new Buddy([
                'accessToken' => 'yourAccessToken'
            ]);
            $resp = $buddy->getApiWebhooks()->getWebhook('domain', 1);
            var_dump($resp);
            exit;

        } catch (BuddyResponseException $e) {
            echo $e->getMessage();
            exit;

        } catch (BuddySDKException $e) {
            echo $e->getMessage();
            exit;

        }
    }

    public function editWebhook()
    {
        try {
            $buddy = new Buddy([
                'accessToken' => 'yourAccessToken'
            ]);
            $webhook = new Webhook();
            $webhook->setEvents([Webhook::EVENT_PUSH, Webhook::EVENT_RELEASE_FAILED, Webhook::EVENT_RELEASE_SUCCESSFUL]);
            $resp = $buddy->getApiWebhooks()->editWebhook($webhook, 'domain', 1);
            var_dump($resp);
            exit;

        } catch (BuddyResponseException $e) {
            echo $e->getMessage();
            exit;

        } catch (BuddySDKException $e) {
            echo $e->getMessage();
            exit;

        }
    }

    public function deleteWebhook()
    {
        try {
            $buddy = new Buddy([
                'accessToken' => 'yourAccessToken'
            ]);
            $resp = $buddy->getApiWebhooks()->deleteWebhook('domain', 1);
            var_dump($resp);
            exit;

        } catch (BuddyResponseException $e) {
            echo $e->getMessage();
            exit;

        } catch (BuddySDKException $e) {
            echo $e->getMessage();
            exit;

        }
    }
}
