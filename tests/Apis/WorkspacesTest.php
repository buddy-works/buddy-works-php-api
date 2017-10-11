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
        $this->assertInstanceOf('Buddy\BuddyResponse', $resp);
        $this->assertInternalType('array', $resp->getBody());
        $this->assertInternalType('array', $resp->getHeaders());
        $this->assertInternalType('int', $resp->getStatusCode());
    }

    public function testGetWorkspace()
    {
        $buddy = new Buddy([
            'accessToken' => getenv('TOKEN_ALL')
        ]);
        $body = $buddy->getApiWorkspaces()->getWorkspaces()->getBody();
        $this->assertGreaterThan(0, $body['workspaces']);
        $resp = $buddy->getApiWorkspaces()->getWorkspace($body['workspaces'][0]['domain']);
        $this->assertInstanceOf('Buddy\BuddyResponse', $resp);
        $this->assertInternalType('array', $resp->getBody());
        $this->assertInternalType('array', $resp->getHeaders());
        $this->assertInternalType('int', $resp->getStatusCode());
    }
}