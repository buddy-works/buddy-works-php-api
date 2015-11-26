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

namespace Buddy\Apis;

use Buddy\BuddyClient;
use Buddy\Exceptions\BuddySDKException;

class Api
{
    /**
     * @var BuddyClient
     */
    protected $client;

    /**
     * @var array
     */
    protected $options;

    /**
     * Api constructor.
     * @param BuddyClient $client
     * @param array $options
     */
    public function __construct(BuddyClient $client, array $options = [])
    {
        $this->client = $client;
        $this->options = $options;
    }

    /**
     * @param string $accessToken
     * @param string $url
     * @param array $params
     * @param array $query
     * @return \Buddy\BuddyResponse
     * @throws BuddySDKException
     */
    protected function getJson($accessToken, $url, array $params = [], array $query = [])
    {
        return $this->client->getJson($this->getAccessToken($accessToken), $this->client->createUrl($url, $params, $query));
    }

    /**
     * @param string $accessToken
     * @return string
     * @throws BuddySDKException
     */
    protected function getAccessToken($accessToken)
    {
        if (isset($accessToken)) {
            return $accessToken;

        } else if (isset($this->options['accessToken'])) {
            return $this->options['accessToken'];

        } else {
            throw new BuddySDKException('No access token provided');
        }
    }
}
