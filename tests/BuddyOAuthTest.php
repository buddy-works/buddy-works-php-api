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

namespace Buddy\Tests;

use Buddy\Buddy;
use Buddy\BuddyOAuth;
use PHPUnit\Framework\TestCase;

class BuddyOAuthTest extends TestCase
{
    public function testGetAuthorizeUrlWithoutClientId(): void
    {
        $this->expectException('Buddy\Exceptions\BuddySDKException');
        $this->expectExceptionMessage('Please provide clientId');
        $app = new Buddy();
        $app->getOAuth()->getAuthorizeUrl([BuddyOAuth::SCOPE_MANAGE_EMAILS], 'test');
    }

    public function testGetAuthorizeUrlWithoutScopes(): void
    {
        $this->expectException('Buddy\Exceptions\BuddySDKException');
        $this->expectExceptionMessage('Please provide at least one scope');
        $app = new Buddy([
            'clientId' => 'foo',
        ]);
        $app->getOAuth()->getAuthorizeUrl([], 'test');
    }

    public function testGetAuthorizeUrlWithoutState(): void
    {
        $this->expectException('Buddy\Exceptions\BuddySDKException');
        $this->expectExceptionMessage('Please provide state');
        $app = new Buddy([
            'clientId' => 'foo',
        ]);
        $app->getOAuth()->getAuthorizeUrl([BuddyOAuth::SCOPE_MANAGE_EMAILS], '');
    }

    public function testGetAuthorizeUrl(): void
    {
        $clientId = getenv('CLIENT_ID');
        $app = new Buddy([
            'clientId' => $clientId,
        ]);
        $url = $app->getOAuth()->getAuthorizeUrl([
            BuddyOAuth::SCOPE_MANAGE_EMAILS,
        ], 'foo');
        $this->assertNotEmpty($url);
    }

    public function testGetAuthorizeUrlWithRedirectUrl(): void
    {
        $clientId = getenv('CLIENT_ID');
        $app = new Buddy([
            'clientId' => $clientId,
        ]);
        $url = $app->getOAuth()->getAuthorizeUrl([
            BuddyOAuth::SCOPE_MANAGE_EMAILS,
        ], 'foo', 'http://127.0.0.1');
        $this->assertNotEmpty($url);
    }

    public function testGetAccessTokenWithoutCode(): void
    {
        $this->expectException('Buddy\Exceptions\BuddySDKException');
        $this->expectExceptionMessage('No code provided');
        $_GET = [];
        $_GET['state'] = 'foo';
        $app = new Buddy([
            'clientId' => 'clientId',
            'clientSecret' => 'secret',
        ]);
        $app->getOAuth()->getAccessToken('foo');
    }

    public function testGetAccessTokenWithoutClientId(): void
    {
        $this->expectException('Buddy\Exceptions\BuddySDKException');
        $this->expectExceptionMessage('Please provide clientId');
        $_GET = [];
        $_GET['code'] = 'code';
        $_GET['state'] = 'foo';
        $app = new Buddy([
            'clientSecret' => 'secret',
        ]);
        $app->getOAuth()->getAccessToken('foo');
    }

    public function testGetAccessTokenWithoutClientSecret(): void
    {
        $this->expectException('Buddy\Exceptions\BuddySDKException');
        $this->expectExceptionMessage('Please provide clientSecret');
        $_GET = [];
        $_GET['code'] = 'code';
        $_GET['state'] = 'foo';
        $app = new Buddy([
            'clientId' => 'clientId',
        ]);
        $app->getOAuth()->getAccessToken('foo');
    }

    public function testGetAccessTokenWithoutState(): void
    {
        $this->expectException('Buddy\Exceptions\BuddySDKException');
        $this->expectExceptionMessage('State does not match');
        $_GET = [];
        $_GET['code'] = 'code';
        $app = new Buddy([
            'clientId' => 'clientId',
            'clientSecret' => 'secret',
        ]);
        $app->getOAuth()->getAccessToken('foo');
    }

    public function testGetAccessToken(): void
    {
        $this->expectException('Buddy\Exceptions\BuddyResponseException');
        $this->expectExceptionMessage('Invalid client_id');
        $_GET = [];
        $_GET['state'] = 'state';
        $_GET['code'] = 'code';
        $app = new Buddy([
            'clientId' => 'clientId',
            'clientSecret' => 'secret',
        ]);
        $app->getOAuth()->getAccessToken('state');
    }

    public function testGetAccessTokenWithRedirectUrl(): void
    {
        $this->expectException('Buddy\Exceptions\BuddyResponseException');
        $this->expectExceptionMessage('Invalid client_id');
        $_GET = [];
        $_GET['state'] = 'state';
        $_GET['code'] = 'code';
        $app = new Buddy([
            'clientId' => 'clientId',
            'clientSecret' => 'secret',
        ]);
        $app->getOAuth()->getAccessToken('state', 'http://12.0.0.1');
    }
}
