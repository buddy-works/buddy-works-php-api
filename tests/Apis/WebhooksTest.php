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

namespace Tests\Apis;

use Buddy\Buddy;
use Buddy\Objects\Webhook;
use Buddy\Tests\Utils;

class WebhooksTest extends \PHPUnit_Framework_TestCase
{
    public function testAddWebhook()
    {
        $project = Utils::addProject();
        $webhook = new Webhook();
        $webhook->setTargetUrl('http://onet.pl');
        $webhook->setSecretKey(Utils::randomString());
        $webhook->setEvents([Webhook::EVENT_RELEASE_FAILED]);
        $webhook->setProjectFilter($project);
        $resp = Utils::getBuddy()->getApiWebhooks()->addWebhook($webhook, Utils::getWorkspaceDomain());
        $this->assertInstanceOf('Buddy\Objects\Webhook', $resp);
        $this->assertEquals($webhook->getTargetUrl(), $resp->getTargetUrl());
        $this->assertEquals($webhook->getSecretKey(), $resp->getSecretKey());
        $this->assertEquals($webhook->getProjectFilter()->getName(), $resp->getProjectFilter()->getName());
        $events = $resp->getEvents();
        $this->assertInternalType('array', $events);
        $this->assertEquals(1, count($events));
        $this->assertEquals(Webhook::EVENT_RELEASE_FAILED, $events[0]);
    }

    public function testAddWebhook2()
    {
        $webhook = new Webhook();
        $webhook->setTargetUrl('http://onet.pl');
        $webhook->setEvents([Webhook::EVENT_RELEASE_FAILED]);
        $resp = Utils::getBuddy()->getApiWebhooks()->addWebhook($webhook, Utils::getWorkspaceDomain());
        $this->assertInstanceOf('Buddy\Objects\Webhook', $resp);
        $this->assertEquals($webhook->getTargetUrl(), $resp->getTargetUrl());
        $this->assertEquals($webhook->getSecretKey(), $resp->getSecretKey());
        $this->assertEquals($webhook->getProjectFilter(), $resp->getProjectFilter());
        $events = $resp->getEvents();
        $this->assertInternalType('array', $events);
        $this->assertEquals(1, count($events));
        $this->assertEquals(Webhook::EVENT_RELEASE_FAILED, $events[0]);
    }

    public function testGetWebhooks()
    {
        Utils::addWebhook();
        $resp = Utils::getBuddy()->getApiWebhooks()->getWebhooks(Utils::getWorkspaceDomain());
        $this->assertInstanceOf('Buddy\Objects\Webhooks', $resp);
        $this->assertNotEmpty($resp->getWebhooks());
        $this->assertNotEmpty($resp->getHtmlUrl());
        $this->assertNotEmpty($resp->getUrl());
    }

    public function testGetWebhook()
    {
        $wh = Utils::addWebhook();
        $resp = Utils::getBuddy()->getApiWebhooks()->getWebhook(Utils::getWorkspaceDomain(), $wh->getId());
        $this->assertInstanceOf('Buddy\Objects\Webhook', $resp);
        $this->assertEquals($wh->getId(), $resp->getId());
    }

    public function testDeleteWebhook()
    {
        $wh = Utils::addWebhook();
        $resp = Utils::getBuddy()->getApiWebhooks()->deleteWebhook(Utils::getWorkspaceDomain(), $wh->getId());
        $this->assertEquals(true, $resp);
    }

    public function testEditWebhook()
    {
        $wh = Utils::addWebhook();
        $project = Utils::addProject();
        $wh->setProjectFilter($project);
        $wh->setEvents([Webhook::EVENT_RELEASE_SUCCESSFUL]);
        $wh->setSecretKey(Utils::randomString());
        $wh->setTargetUrl('http://wp.pl');
        $resp = Utils::getBuddy()->getApiWebhooks()->editWebhook($wh, Utils::getWorkspaceDomain(), $wh->getId());
        $this->assertInstanceOf('Buddy\Objects\Webhook', $resp);
        $this->assertEquals($wh->getTargetUrl(), $resp->getTargetUrl());
        $this->assertEquals($wh->getSecretKey(), $resp->getSecretKey());
        $this->assertEquals($wh->getProjectFilter()->getName(), $resp->getProjectFilter()->getName());
        $events = $resp->getEvents();
        $this->assertInternalType('array', $events);
        $this->assertEquals(1, count($events));
        $this->assertEquals(Webhook::EVENT_RELEASE_SUCCESSFUL, $events[0]);
    }

    public function testEditWebhookOnlyTargetUrl()
    {
        $wh = Utils::addWebhook();
        $wh->setTargetUrl('http://wp.pl');
        $resp = Utils::getBuddy()->getApiWebhooks()->editWebhook($wh, Utils::getWorkspaceDomain(), $wh->getId());
        $this->assertInstanceOf('Buddy\Objects\Webhook', $resp);
        $this->assertEquals($wh->getTargetUrl(), $resp->getTargetUrl());
        $this->assertEquals($wh->getSecretKey(), $resp->getSecretKey());
        $this->assertEquals($wh->getProjectFilter(), $resp->getProjectFilter());
        $events = $resp->getEvents();
        $this->assertInternalType('array', $events);
        $this->assertEquals(1, count($events));
        $this->assertEquals(Webhook::EVENT_RELEASE_FAILED, $events[0]);
    }
}