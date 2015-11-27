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

class Webhook extends Object
{
    const EVENT_PUSH = 'PUSH';
    const EVENT_RELEASE_STARTED = 'RELEASE_STARTED';
    const EVENT_RELEASE_SUCCESSFUL = 'RELEASE_SUCCESSFUL';
    const EVENT_RELEASE_FAILED = 'RELEASE_FAILED';
    const EVENT_RELEASE_FINISHED = 'RELEASE_FINISHED';

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $targetUrl;

    /**
     * @var string
     */
    protected $secretKey;

    /**
     * @var Project
     */
    protected $projectFilter;

    /**
     * @var array
     */
    protected $events;

    /**
     * Webhook constructor.
     * @param array $json
     * @param array $headers
     * @param int $status
     */
    public function __construct(array $json = [], array $headers = [], $status = 200)
    {
        parent::__construct($json, $headers, $status);
        $this->setFromJson('id');
        $this->setFromJson('targetUrl', 'target_url');
        $this->setFromJson('secretKey', 'secret_key');
        $this->setFromJsonAsObject('Buddy\Objects\Project', 'projectFilter', 'project_filter');
        $this->setFromJson('events');
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTargetUrl()
    {
        return $this->targetUrl;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setTargetUrl($val)
    {
        $this->targetUrl = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setSecretKey($val)
    {
        $this->secretKey = $val;
        return $this;
    }

    /**
     * @return Project
     */
    public function getProjectFilter()
    {
        return $this->projectFilter;
    }

    /**
     * @param Project $val
     * @return $this
     */
    public function setProjectFilter($val)
    {
        $this->projectFilter = $val;
        return $this;
    }

    /**
     * @return array
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param array $val
     * @return $this
     */
    public function setEvents($val)
    {
        $this->events = $val;
        return $this;
    }
}
