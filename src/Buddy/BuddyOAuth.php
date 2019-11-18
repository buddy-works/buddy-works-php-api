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

namespace Buddy;

use Buddy\Exceptions\BuddySDKException;

class BuddyOAuth
{
    const SCOPE_WORKSPACE = 'WORKSPACE';
    const SCOPE_PROJECT_DELETE = 'PROJECT_DELETE';
    const SCOPE_REPOSITORY_READ = 'REPOSITORY_READ';
    const SCOPE_REPOSITORY_WRITE = 'REPOSITORY_WRITE';
    const SCOPE_EXECUTION_INFO = 'EXECUTION_INFO';
    const SCOPE_EXECUTION_RUN = 'EXECUTION_RUN';
    const SCOPE_EXECUTION_MANAGE = 'EXECUTION_MANAGE';
    const SCOPE_USER_INFO = 'USER_INFO';
    const SCOPE_USER_KEY = 'USER_KEY';
    const SCOPE_USER_EMAIL = 'USER_EMAIL';
    const SCOPE_INTEGRATION_INFO = 'INTEGRATION_INFO';
    const SCOPE_MEMBER_EMAIL = 'MEMBER_EMAIL';
    const SCOPE_MANAGE_EMAILS = 'MANAGE_EMAILS';
    const SCOPE_WEBHOOK_INFO = 'WEBHOOK_INFO';
    const SCOPE_WEBHOOK_ADD = 'WEBHOOK_ADD';
    const SCOPE_WEBHOOK_MANAGE = 'WEBHOOK_MANAGE';

    /**
     * @var BuddyClient
     */
    private $client;

    /**
     * @var array
     */
    private $options;

    /**
     * BuddyOAuth constructor.
     *
     * @param $options
     */
    public function __construct(BuddyClient $client, $options)
    {
        $this->client = $client;
        $this->options = $options;
    }

    /**
     * @param string      $state
     * @param string|null $redirectUrl
     *
     * @throws BuddySDKException
     *
     * @return string
     */
    public function getAuthorizeUrl(array $scopes, $state, $redirectUrl = null)
    {
        if (count($scopes) == 0) {
            throw new BuddySDKException('Please provide at least one scope');
        }
        if (empty($state)) {
            throw new BuddySDKException('Please provide state');
        }
        if (empty($this->options['clientId'])) {
            throw new BuddySDKException('Please provide clientId');
        }
        $query = [
            'type' => 'web_server',
            'response_type' => 'code',
            'client_id' => $this->options['clientId'],
            'scope' => join(' ', $scopes),
            'state' => $state,
        ];
        if (isset($redirectUrl)) {
            $query['redirect_uri'] = $redirectUrl;
        }

        return $this->client->createUrl('/oauth2/authorize', [], $query);
    }

    /**
     * @param string      $state
     * @param string|null $redirectUrl
     *
     * @throws BuddySDKException
     *
     * @return array
     */
    public function getAccessToken($state, $redirectUrl = null)
    {
        if (empty($_GET['state']) || $_GET['state'] != $state) {
            throw new BuddySDKException('State does not match');
        }
        if (empty($_GET['code'])) {
            throw new BuddySDKException('No code provided');
        }
        if (empty($this->options['clientId'])) {
            throw new BuddySDKException('Please provide clientId');
        }
        if (empty($this->options['clientSecret'])) {
            throw new BuddySDKException('Please provide clientSecret');
        }
        $params = [
            'code' => $_GET['code'],
            'client_id' => $this->options['clientId'],
            'client_secret' => $this->options['clientSecret'],
            'grant_type' => 'authorization_code',
        ];
        if (isset($redirectUrl)) {
            $params['redirect_uri'] = $redirectUrl;
        }

        return $this->client->post($this->client->createUrl('/oauth2/token'), $params)->getBody();
    }
}
