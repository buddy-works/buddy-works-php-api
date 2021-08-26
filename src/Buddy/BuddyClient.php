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

use Buddy\Exceptions\BuddyResponseException;
use Buddy\Exceptions\BuddySDKException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

class BuddyClient
{
    public const API_ENDPOINT = 'https://api.buddy.works';

    private Client $guzzle;

    public function __construct()
    {
        $this->guzzle = new Client();
    }

    /**
     * @codeCoverageIgnore
     *
     * @param mixed[] $options
     *
     * @throws BuddyResponseException
     * @throws BuddySDKException
     */
    private function request(string $url, string $method, array $options = []): BuddyResponse
    {
        $options = array_merge($options, [
            'timeout' => 60,
            'connect_timeout' => 30,
        ]);

        try {
            $rawResponse = $this->guzzle->request($method, $url, $options);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $rawResponse = $e->getResponse();
            } else {
                throw new BuddySDKException($e->getMessage(), $e->getCode());
            }
        }
        if (!$rawResponse instanceof ResponseInterface) {
            throw new BuddySDKException('Invalid response');
        }
        $httpStatusCode = $rawResponse->getStatusCode();
        if ($httpStatusCode >= 200 && $httpStatusCode < 300) {
            return new BuddyResponse($rawResponse->getStatusCode(), $rawResponse->getHeaders(), (string) $rawResponse->getBody());
        }
        throw new BuddyResponseException($rawResponse->getStatusCode(), $rawResponse->getHeaders(), (string) $rawResponse->getBody());
    }

    /**
     * @param mixed[]|null $body
     *
     * @throws BuddyResponseException
     * @throws BuddySDKException
     */
    private function requestJson(string $accessToken, string $url, string $method, ?array $body = null): BuddyResponse
    {
        $options = [
            'headers' => [
                'Authorization' => 'Bearer '.$accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ];
        if (isset($body)) {
            $options['json'] = $body;
        }

        return $this->request($url, $method, $options);
    }

    /**
     * @codeCoverageIgnore
     *
     * @param mixed[] $params
     * @param mixed[] $query
     */
    public function createUrl(string $url, array $params = [], array $query = [], string $path = '/'): string
    {
        if (count($params) > 0) {
            foreach ($params as $k => $v) {
                $url = preg_replace("/:{$k}/", urlencode((string) $v), (string) $url);
            }
        }
        if (count($query) > 0) {
            $url .= '?'.http_build_query($query);
        }
        if ($path !== '/' && $path !== '') {
            $path = '/'.ltrim($path, '/');
            $path = urlencode($path);
            $path = preg_replace('/%2F/', '/', $path);
            $url .= $path;
        }

        return self::API_ENDPOINT.$url;
    }

    public function getJson(string $accessToken, string $url): BuddyResponse
    {
        return $this->requestJson($accessToken, $url, 'GET');
    }

    /**
     * @param mixed[]|null $body
     */
    public function deleteJson(string $accessToken, string $url, ?array $body = null): BuddyResponse
    {
        return $this->requestJson($accessToken, $url, 'DELETE', $body);
    }

    /**
     * @param mixed[] $body
     */
    public function postJson(string $accessToken, string $url, array $body): BuddyResponse
    {
        return $this->requestJson($accessToken, $url, 'POST', $body);
    }

    /**
     * @param mixed[] $body
     */
    public function putJson(string $accessToken, string $url, array $body): BuddyResponse
    {
        return $this->requestJson($accessToken, $url, 'PUT', $body);
    }

    /**
     * @param mixed[] $body
     */
    public function patchJson(string $accessToken, string $url, array $body): BuddyResponse
    {
        return $this->requestJson($accessToken, $url, 'PATCH', $body);
    }

    /**
     * @codeCoverageIgnore
     *
     * @param mixed[] $params
     *
     * @throws BuddyResponseException
     * @throws BuddySDKException
     */
    public function post(string $url, array $params): BuddyResponse
    {
        return $this->request($url, 'POST', [
            'form_params' => $params,
        ]);
    }

    /**
     * @codeCoverageIgnore
     *
     * @throws BuddyResponseException
     * @throws BuddySDKException
     */
    public function get(string $url): BuddyResponse
    {
        return $this->request($url, 'GET');
    }
}
