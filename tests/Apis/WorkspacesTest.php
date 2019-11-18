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

namespace Buddy\Tests\Apis;

use Buddy\Buddy;
use PHPUnit\Framework\TestCase;

class WorkspacesTest extends TestCase
{
    public function testApiException(): void
    {
        $this->expectException('Buddy\Exceptions\BuddySDKException');
        $this->expectExceptionMessage('No access token provided');
        $buddy = new Buddy();
        $buddy->getApiWorkspaces()->getWorkspaces();
    }

    public function testGetWorkspaces(): void
    {
        $buddy = new Buddy([
            'accessToken' => getenv('TOKEN_ALL'),
        ]);
        $this->assertInstanceOf('Buddy\Apis\Workspaces', $buddy->getApiWorkspaces());
        $resp = $buddy->getApiWorkspaces()->getWorkspaces();
        $this->assertInstanceOf('Buddy\BuddyResponse', $resp);
        $this->assertIsArray($resp->getBody());
        $this->assertIsArray($resp->getHeaders());
        $this->assertIsInt($resp->getStatusCode());
    }

    public function testGetWorkspace(): void
    {
        $buddy = new Buddy([
            'accessToken' => getenv('TOKEN_ALL'),
        ]);
        $body = $buddy->getApiWorkspaces()->getWorkspaces()->getBody();
        $this->assertGreaterThan(0, $body['workspaces']);
        $resp = $buddy->getApiWorkspaces()->getWorkspace($body['workspaces'][0]['domain']);
        $this->assertInstanceOf('Buddy\BuddyResponse', $resp);
        $this->assertIsArray($resp->getBody());
        $this->assertIsArray($resp->getHeaders());
        $this->assertIsInt($resp->getStatusCode());
    }
}
