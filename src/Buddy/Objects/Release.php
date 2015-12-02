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

class Release extends Object
{
    const STATUS_INPROGRESS = 'INPROGRESS';
    const STATUS_ENQUEUED = 'ENQUEUED';
    const STATUS_TERMINATED = 'TERMINATED';
    const STATUS_SUCCESSFUL = 'SUCCESSFUL';
    const STATUS_FAILED = 'FAILED';
    const STATUS_INITIAL = 'INITIAL';

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $startDate;

    /**
     * @var string
     */
    protected $finishDate;

    /**
     * @var bool
     */
    protected $automatic;

    /**
     * @var bool
     */
    protected $refresh;

    /**
     * @var string
     */
    protected $comment;

    /**
     * @var User
     */
    protected $creator;

    /**
     * @var Scenario
     */
    protected $scenario;

    /**
     * @var array
     */
    protected $actionExecutions;

    /**
     * @var string
     */
    protected $revision;

    /**
     * @var string
     */
    protected $status;

    /**
     * Release constructor.
     * @param array $json
     * @param array $headers
     * @param int $status
     */
    public function __construct(array $json = [], array $headers = [], $status = 200)
    {
        parent::__construct($json, $headers, $status);
        $this->setFromJson('id');
        $this->setFromJson('startDate', 'start_date');
        $this->setFromJson('finishDate', 'finish_date');
        $this->setFromJson('automatic');
        $this->setFromJson('refresh');
        $this->setFromJson('comment');
        $this->setFromJson('status');
        $this->setFromJsonAsObject('Buddy\Objects\User', 'creator');
        $this->setFromJsonAsObject('Buddy\Objects\Scenario', 'scenario', 'release_scenario');
        $this->setFromJsonAsArray('Buddy\Objects\ActionExecution', 'actionExecutions', 'action_executions');
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getRevision()
    {
        return $this->revision;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setRevision($val)
    {
        $this->revision = $val;
        return $this;
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
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @return string
     */
    public function getFinishDate()
    {
        return $this->finishDate;
    }

    /**
     * @return bool
     */
    public function getAutomatic()
    {
        return $this->automatic;
    }

    /**
     * @return bool
     */
    public function getRefresh()
    {
        return $this->refresh;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setComment($val)
    {
        $this->comment = $val;
        return $this;
    }

    /**
     * @return User
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @return Scenario
     */
    public function getScenario()
    {
        return $this->scenario;
    }

    /**
     * @return array
     */
    public function getActionExecutions()
    {
        return $this->actionExecutions;
    }
}
