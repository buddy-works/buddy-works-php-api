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

namespace Buddy\Exceptions;

use GuzzleHttp\Message\ResponseInterface;
use Mockery\CountValidator\Exception;

class BuddyResponseException extends BuddySDKException
{
    /**
     * @var array
     */
    private $headers;

    /**
     * @var string
     */
    private $rawBody;

    /**
     * BuddyResponseException constructor.
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->code = $response->getStatusCode();
        $this->headers = $response->getHeaders();
        $this->rawBody = (string)$response->getBody();
        $this->message = 'Something went wrong';
        try {
            $body = json_decode($this->rawBody, true);
            if (!empty($body['error'])){
                $this->message = $body['error'];
            }else if (!empty($body['errors']) && is_array($body['errors']) && !empty($body['errors'][0]) && !empty($body['errors'][0]['message'])) {
                $this->message = $body['errors'][0]['message'];
            }
        } catch (Exception $e) {
        }
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return string
     */
    public function getRawBody()
    {
        return $this->rawBody;
    }
}
