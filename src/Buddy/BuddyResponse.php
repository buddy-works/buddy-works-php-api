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

use Mockery\Exception;

class BuddyResponse
{
    /**
     * @var array
     */
    private $body;

    /**
     * @var array
     */
    private $headers;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * BuddyResponse constructor.
     * @param int $statusCode
     * @param array $headers
     * @param string $body
     */
    public function __construct($statusCode, $headers, $body)
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        try {
            $this->body = json_decode($body, true);
        } catch (Exception $e) {
            $this->body = array();
        }
    }

    /**
     * @return bool
     */
    public function isOk()
    {
        return $this->getStatusCode() >= 200 && $this->getStatusCode() < 300;
    }

    /**
     * @return array
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
