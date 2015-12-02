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

namespace Buddy;

use Buddy\Exceptions\BuddySDKException;
use Buddy\Exceptions\BuddyResponseException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class BuddyClient
{

    const API_ENDPOINT = 'https://api.buddy.works';

    /**
     * @var \GuzzleHttp\Client
     */
    private $guzzle;

    /**
     * BuddyClient constructor.
     */
    public function __construct()
    {
        $this->guzzle = new Client();
    }

    /**
     * @codeCoverageIgnore
     * @param string $url
     * @param string $method
     * @param array $options
     * @return BuddyResponse
     * @throws BuddyResponseException
     * @throws BuddySDKException
     */
    private function request($url, $method, $options = [])
    {
        array_merge($options, [
            'timeout' => 60,
            'connect_timeout' => 30
        ]);
        $request = $this->guzzle->createRequest($method, $url, $options);
        try {
            $rawResponse = $this->guzzle->send($request);

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $rawResponse = $e->getResponse();
            } else {
                throw new BuddySDKException($e->getMessage(), $e->getCode());
            }
        }
        $httpStatusCode = $rawResponse->getStatusCode();
        if ($httpStatusCode >= 200 && $httpStatusCode < 300) {
            return new BuddyResponse($rawResponse->getStatusCode(), $rawResponse->getHeaders(), (string)$rawResponse->getBody());
        } else {
            throw new BuddyResponseException($rawResponse->getStatusCode(), $rawResponse->getHeaders(), (string)$rawResponse->getBody());
        }
    }

    /**
     * @param string $accessToken
     * @param string $url
     * @param string $method
     * @param null|array $body
     * @return BuddyResponse
     * @throws BuddyResponseException
     * @throws BuddySDKException
     */
    private function requestJson($accessToken, $url, $method, $body = null)
    {
        $options = [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ]
        ];
        if (isset($body)) {
            $options['json'] = $body;
        }
        return $this->request($url, $method, $options);
    }

    /**
     * @codeCoverageIgnore
     * @param string $url
     * @param array $params
     * @param array $query
     * @param string $path
     * @return string
     */
    public function createUrl($url, array $params = [], array $query = [], $path = '/')
    {
        if (count($params) > 0) {
            foreach ($params as $k => $v) {
                $url = preg_replace("/:{$k}/", urlencode($v), $url);
            }
        }
        if (count($query) > 0) {
            $url .= '?' . http_build_query($query);
        }
        if ($path != '/' && $path != '') {
            $path = '/' . ltrim($path, '/');
            $path = urlencode($path);
            $path = preg_replace('/%2F/', '/', $path);
            $url .= $path;
        }
        return self::API_ENDPOINT . $url;
    }

    /**
     * @param string $accessToken
     * @param string $url
     * @return BuddyResponse
     */
    public function getJson($accessToken, $url)
    {
        return $this->requestJson($accessToken, $url, 'GET');
    }

    /**
     * @param string $accessToken
     * @param string $url
     * @param null|array $body
     * @return BuddyResponse
     */
    public function deleteJson($accessToken, $url, $body = null)
    {
        return $this->requestJson($accessToken, $url, 'DELETE', $body);
    }

    /**
     * @param string $accessToken
     * @param string $url
     * @param array $body
     * @return BuddyResponse
     */
    public function postJson($accessToken, $url, $body)
    {
        return $this->requestJson($accessToken, $url, 'POST', $body);
    }

    /**
     * @param string $accessToken
     * @param string $url
     * @param array $body
     * @return BuddyResponse
     */
    public function putJson($accessToken, $url, $body)
    {
        return $this->requestJson($accessToken, $url, 'PUT', $body);
    }

    /**
     * @param string $accessToken
     * @param string $url
     * @param array $body
     * @return BuddyResponse
     */
    public function patchJson($accessToken, $url, $body)
    {
        return $this->requestJson($accessToken, $url, 'PATCH', $body);
    }

    /**
     * @codeCoverageIgnore
     * @param string $url
     * @param array $params
     * @return BuddyResponse
     * @throws BuddyResponseException
     * @throws BuddySDKException
     */
    public function post($url, array $params)
    {
        return $this->request($url, 'POST', [
            'body' => $params
        ]);
    }

    /**
     * @codeCoverageIgnore
     * @param string $url
     * @return BuddyResponse
     * @throws BuddyResponseException
     * @throws BuddySDKException
     */
    public function get($url)
    {
        return $this->request($url, 'GET');
    }
}
