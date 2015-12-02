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

class Scenario extends Object
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
    protected $name;

    /**
     * @var string
     */
    protected $branch;

    /**
     * @var bool
     */
    protected $automatic;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $createDate;

    /**
     * @var Project
     */
    protected $project;

    /**
     * @var User
     */
    protected $creator;

    /**
     * @var array
     */
    protected $actions;

    /**
     * Scenario constructor.
     * @param array $json
     * @param array $headers
     * @param int $status
     */
    public function __construct(array $json = [], array $headers = [], $status = 200)
    {
        parent::__construct($json, $headers, $status);
        $this->setFromJson('id');
        $this->setFromJson('name');
        $this->setFromJson('branch');
        $this->setFromJson('automatic');
        $this->setFromJson('status');
        $this->setFromJson('createDate', 'create_date');
        $this->setFromJsonAsObject('Buddy\Objects\Project', 'project');
        $this->setFromJsonAsObject('Buddy\Objects\User', 'creator');
        $this->setFromJsonAsArray('Buddy\Objects\ScenarioAction', 'actions');
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setName($val)
    {
        $this->name = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getBranch()
    {
        return $this->branch;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setBranch($val)
    {
        $this->branch = $val;
        return $this;
    }

    /**
     * @return bool
     */
    public function getAutomatic()
    {
        return $this->automatic;
    }

    /**
     * @param bool $val
     * @return $this
     */
    public function setAutomatic($val)
    {
        $this->automatic = $val;
        return $this;
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
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @return User
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @return array
     */
    public function getActions()
    {
        return $this->actions;
    }
}
