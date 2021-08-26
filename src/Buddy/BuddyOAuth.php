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
    public const SCOPE_WORKSPACE = 'WORKSPACE';
    public const SCOPE_PROJECT_DELETE = 'PROJECT_DELETE';
    public const SCOPE_REPOSITORY_READ = 'REPOSITORY_READ';
    public const SCOPE_REPOSITORY_WRITE = 'REPOSITORY_WRITE';
    public const SCOPE_EXECUTION_INFO = 'EXECUTION_INFO';
    public const SCOPE_EXECUTION_RUN = 'EXECUTION_RUN';
    public const SCOPE_EXECUTION_MANAGE = 'EXECUTION_MANAGE';
    public const SCOPE_USER_INFO = 'USER_INFO';
    public const SCOPE_USER_KEY = 'USER_KEY';
    public const SCOPE_USER_EMAIL = 'USER_EMAIL';
    public const SCOPE_INTEGRATION_INFO = 'INTEGRATION_INFO';
    public const SCOPE_MEMBER_EMAIL = 'MEMBER_EMAIL';
    public const SCOPE_MANAGE_EMAILS = 'MANAGE_EMAILS';
    public const SCOPE_WEBHOOK_INFO = 'WEBHOOK_INFO';
    public const SCOPE_WEBHOOK_ADD = 'WEBHOOK_ADD';
    public const SCOPE_WEBHOOK_MANAGE = 'WEBHOOK_MANAGE';

    private BuddyClient $client;

    /**
     * @var mixed[]
     */
    private array $options;

    /**
     * @param mixed[] $options
     */
    public function __construct(BuddyClient $client, array $options)
    {
        $this->client = $client;
        $this->options = $options;
    }

    /**
     * @param string[] $scopes
     *
     * @throws BuddySDKException
     */
    public function getAuthorizeUrl(array $scopes, string $state, ?string $redirectUrl = null): string
    {
        if (count($scopes) === 0) {
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
     * @throws BuddySDKException
     *
     * @return mixed[]
     */
    public function getAccessToken(string $state, ?string $redirectUrl = null): array
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
