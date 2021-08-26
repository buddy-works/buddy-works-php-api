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

namespace Buddy\Exceptions;

use Exception;

class BuddyResponseException extends BuddySDKException
{
    /**
     * @var mixed[]
     */
    private array $headers;

    private string $body;

    private int $statusCode;

    /**
     * @param mixed[] $headers
     */
    public function __construct(int $statusCode, array $headers, string $body)
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        $this->body = $body;
        $this->message = 'Something went wrong';
        parent::__construct($this->message);
        try {
            $body = json_decode($this->body, true);
            if (!empty($body['error'])) {
                $this->message = $body['error'];
            } elseif (!empty($body['errors']) && is_array($body['errors']) && !empty($body['errors'][0]) && !empty($body['errors'][0]['message'])) {
                $this->message = $body['errors'][0]['message'];
            }
        } catch (Exception $e) {
        }
    }

    /**
     * @return mixed[]
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
