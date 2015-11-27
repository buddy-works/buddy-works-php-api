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
use Buddy\BuddyClient;
use Buddy\BuddyOAuth;

class BuddyOAuthTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $opts = [
            'clientId' => 'foo',
            'clientSecret' => 'bar'
        ];
        $oauth = new BuddyOAuth(new BuddyClient(), $opts);
        $this->assertInstanceOf('Buddy\BuddyClient', \PHPUnit_Framework_Assert::readAttribute($oauth, 'client'));
        $this->assertEquals($opts, \PHPUnit_Framework_Assert::readAttribute($oauth, 'options'));

    }

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

    public function testGetAuthorizeUrl()
    {
        $clientId = getenv('CLIENT_ID');
        $app = new Buddy([
            'clientId' => $clientId
        ]);
        $url = $app->getOAuth()->getAuthorizeUrl([
            BuddyOAuth::SCOPE_MANAGE_EMAILS
        ], 'foo');
        $this->assertNotEmpty($url);
    }

    public function testGetAuthorizeUrlWithRedirectUrl()
    {
        $clientId = getenv('CLIENT_ID');
        $app = new Buddy([
            'clientId' => $clientId
        ]);
        $url = $app->getOAuth()->getAuthorizeUrl([
            BuddyOAuth::SCOPE_MANAGE_EMAILS
        ], 'foo', 'http://127.0.0.1');
        $this->assertNotEmpty($url);
    }

    /**
     * @expectedException \Buddy\Exceptions\BuddySDKException
     * @expectedExceptionMessage No code provided
     */
    public function testGetAccessTokenWithoutCode()
    {
        $_GET = [];
        $_GET['state'] = 'foo';
        $app = new Buddy([
            'clientId' => 'clientId',
            'clientSecret' => 'secret'
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
        $app->getOAuth()->getAccessToken('foo');
    }

    /**
     * @expectedException \Buddy\Exceptions\BuddyResponseException
     * @expectedExceptionMessage Invalid client_id
     */
    public function testGetAccessToken()
    {
        $_GET = [];
        $_GET['state'] = 'state';
        $_GET['code'] = 'code';
        $app = new Buddy([
            'clientId' => 'clientId',
            'clientSecret' => 'secret'
        ]);
        $app->getOAuth()->getAccessToken('state');
    }

    /**
     * @expectedException \Buddy\Exceptions\BuddyResponseException
     * @expectedExceptionMessage Invalid client_id
     */
    public function testGetAccessTokenWithRedirectUrl()
    {
        $_GET = [];
        $_GET['state'] = 'state';
        $_GET['code'] = 'code';
        $app = new Buddy([
            'clientId' => 'clientId',
            'clientSecret' => 'secret'
        ]);
        $app->getOAuth()->getAccessToken('state', 'http://12.0.0.1');
    }

}
