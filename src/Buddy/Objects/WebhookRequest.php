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

namespace Buddy\Objects;

class WebhookRequest extends Object
{
    /**
     * @var string
     */
    protected $postDate;

    /**
     * @var int
     */
    protected $responseStatus;

    /**
     * @var string
     */
    protected $body;

    /**
     * WebhookRequest constructor.
     * @param array $json
     * @param array $headers
     * @param int $status
     */
    public function __construct(array $json = [], array $headers = [], $status = 200)
    {
        parent::__construct($json, $headers, $status);
        $this->setFromJson('postDate', 'post_date');
        $this->setFromJson('responseStatus', 'response_status');
        $this->setFromJson('body');
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return int
     */
    public function getResponseStatus()
    {
        return $this->responseStatus;
    }

    /**
     * @return string
     */
    public function getPostDate()
    {
        return $this->postDate;
    }
}
