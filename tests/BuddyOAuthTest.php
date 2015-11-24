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

namespace Buddy\Tests;

use Buddy\Buddy;
use Buddy\BuddyOAuth;

class BuddyOAuthTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Buddy\Exceptions\BuddySDKException
     * @expectedExceptionMessage Please provide clientId
     */
    public function testGetAuthorizeUrlWithoutClientId()
    {
        $app = new Buddy();
        $app->getOAuth()->getAuthorizeUrl([BuddyOAuth::SCOPE_MANAGE_EMAILS], 'test');
    }

    /**
     * @expectedException \Buddy\Exceptions\BuddySDKException
     * @expectedExceptionMessage Please provide at least one scope
     */
    public function testGetAuthorizeUrlWithoutScopes()
    {
        $app = new Buddy([
            'clientId' => 'foo'
        ]);
        $app->getOAuth()->getAuthorizeUrl([], 'test');
    }

    /**
     * @expectedException \Buddy\Exceptions\BuddySDKException
     * @expectedExceptionMessage Please provide state
     */
    public function testGetAuthorizeUrlWithoutState()
    {
        $app = new Buddy([
            'clientId' => 'foo'
        ]);
        $app->getOAuth()->getAuthorizeUrl([BuddyOAuth::SCOPE_MANAGE_EMAILS], '');
    }

    public function testGetAuthorizeUrlWithFakeData()
    {
        $clientId = getenv('CLIENT_ID');
        if (empty($clientId)) $clientId = 'foo';
        $app = new Buddy([
            'clientId' => $clientId
        ]);
        $url = $app->getOAuth()->getAuthorizeUrl([
            BuddyOAuth::SCOPE_MANAGE_EMAILS,
            BuddyOAuth::SCOPE_MEMBER_EMAIL,
            BuddyOAuth::SCOPE_PROJECT_DELETE,
            BuddyOAuth::SCOPE_RELEASE_INFO,
            BuddyOAuth::SCOPE_RELEASE_MANAGE,
            BuddyOAuth::SCOPE_RELEASE_RUN,
            BuddyOAuth::SCOPE_REPOSITORY_READ,
            BuddyOAuth::SCOPE_REPOSITORY_WRITE,
            BuddyOAuth::SCOPE_USER_EMAIL,
            BuddyOAuth::SCOPE_USER_INFO,
            BuddyOAuth::SCOPE_USER_KEY,
            BuddyOAuth::SCOPE_WEBHOOK_ADD,
            BuddyOAuth::SCOPE_WEBHOOK_INFO,
            BuddyOAuth::SCOPE_WEBHOOK_MANAGE,
            BuddyOAuth::SCOPE_WORKSPACE
        ], 'foo');
        $this->assertNotEmpty($url);
    }

    /**
     * @expectedException \Buddy\Exceptions\BuddySDKException
     * @expectedExceptionMessage No code provided
     */
    public function testGetAccessTokenWithoutCode()
    {
        $clientId = getenv('CLIENT_ID');
        $_GET = [];
        $_GET['state'] = 'foo';
        $clientSecret = getenv('CLIENT_SECRET');
        if (empty($clientId) || empty($clientSecret)){
            return;
        }
        $app = new Buddy([
            'clientId' => $clientId,
            'clientSecret' => $clientSecret
        ]);
        $app->getOAuth()->getAccessToken('foo');
    }

    /**
     * @expectedException \Buddy\Exceptions\BuddySDKException
     * @expectedExceptionMessage Please provide clientId
     */
    public function testGetAccessTokenWithoutClientId()
    {
        $_GET = [];
        $_GET['code'] = 'code';
        $_GET['state'] = 'foo';
        $app = new Buddy([
            'clientSecret' => 'secret'
        ]);
        $app->getOAuth()->getAccessToken('foo');
    }

    /**
     * @expectedException \Buddy\Exceptions\BuddySDKException
     * @expectedExceptionMessage Please provide clientSecret
     */
    public function testGetAccessTokenWithoutClientSecret()
    {
        $_GET = [];
        $_GET['code'] = 'code';
        $_GET['state'] = 'foo';
        $app = new Buddy([
            'clientId' => 'clientId'
        ]);
        $app->getOAuth()->getAccessToken('foo');
    }

    /**
     * @expectedException \Buddy\Exceptions\BuddySDKException
     * @expectedExceptionMessage State does not match
     */
    public function testGetAccessTokenWithoutState()
    {
        $_GET = [];
        $_GET['code'] = 'code';
        $app = new Buddy([
            'clientId' => 'clientId',
            'clientSecret' => 'secret'
        ]);
        $token = $app->getOAuth()->getAccessToken('foo');
        $this->assertNotEmpty($token);
    }

    /**
     * @throws \Buddy\Exceptions\BuddySDKException
     */
    public function testGetAccessToken()
    {
        $_GET = [];
        $clientId = getenv('CLIENT_ID');
        $clientSecret = getenv('CLIENT_SECRET');
        $_GET['code'] = getenv('CODE');
        $_GET['state'] = 'foo';
        if (empty($clientId) || empty($clientSecret) || empty($_GET['code'])){
            return;
        }
        $app = new Buddy([
            'clientId' => $clientId,
            'clientSecret' => $clientSecret
        ]);
        $token = $app->getOAuth()->getAccessToken('foo');
        $this->assertNotEmpty($token);
    }
}
