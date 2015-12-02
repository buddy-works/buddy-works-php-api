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

namespace Buddy\Tests\Apis;

use Buddy\Buddy;

class WorkspacesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Buddy\Exceptions\BuddySDKException
     * @expectedExceptionMessage No access token provided
     */
    public function testApiException()
    {
        $buddy = new Buddy();
        $buddy->getApiWorkspaces()->getWorkspaces();
    }

    public function testGetWorkspaces()
    {
        $token = getenv('TOKEN_ALL');
        $buddy = new Buddy();
        $this->assertInstanceOf('Buddy\Apis\Workspaces', $buddy->getApiWorkspaces());
        $resp = $buddy->getApiWorkspaces()->getWorkspaces($token);
        $this->assertInstanceOf('Buddy\Objects\Workspaces', $resp);
        $this->assertNotEmpty($resp->getUrl());
        $this->assertNotEmpty($resp->getHtmlUrl());
        $this->assertInternalType('array', $resp->getWorkspaces());
        $this->assertInternalType('array', $resp->getJson());
        $this->assertInternalType('int', $resp->getHttpRequestStatus());
        $this->assertInternalType('array', $resp->getHttpRequestHeaders());
    }

    public function testGetWorkspace()
    {
        $buddy = new Buddy([
            'accessToken' => getenv('TOKEN_ALL')
        ]);
        $arr = $buddy->getApiWorkspaces()->getWorkspaces()->getWorkspaces();
        $this->assertGreaterThan(0, count($arr));
        $resp = $buddy->getApiWorkspaces()->getWorkspace($arr[0]->getDomain());
        $this->assertInstanceOf('Buddy\Objects\Workspace', $resp);
        $this->assertNotEmpty($resp->getCreateDate());
        $this->assertNotEmpty($resp->getHtmlUrl());
        $this->assertNotEmpty($resp->getUrl());
        $this->assertNotEmpty($resp->getDomain());
        $this->assertNotEmpty($resp->getId());
        $this->assertNotEmpty($resp->getName());
        $this->assertNotEmpty($resp->getOwnerId());
        $this->assertInternalType('bool', $resp->getFrozen());
        $this->assertInternalType('array', $resp->getJson());
    }
}