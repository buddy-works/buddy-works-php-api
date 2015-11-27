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

class Project extends Object
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $displayName;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $createDate;

    /**
     * @var string
     */
    protected $httpRepository;

    /**
     * @var string
     */
    protected $sshRepository;

    /**
     * @var int
     */
    protected $size;

    /**
     * @var string
     */
    protected $defaultBranch;

    /**
     * @var User
     */
    protected $createdBy;

    /**
     * Project constructor.
     * @param array $json
     * @param array $headers
     * @param int $status
     */
    public function __construct(array $json = [], array $headers = [], $status = 200)
    {
        parent::__construct($json, $headers, $status);
        $this->setFromJson('name');
        $this->setFromJson('displayName', 'display_name');
        $this->setFromJson('status');
        $this->setFromJson('createDate', 'create_date');
        $this->setFromJson('httpRepository', 'http_repository');
        $this->setFromJson('sshRepository', 'ssh_repository');
        $this->setFromJson('size');
        $this->setFromJson('defaultBranch', 'default_branch');
        $this->setFromJsonAsObject('Buddy\Objects\User', 'createdBy', 'created_by');
    }

    /**
     * @return User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @return string
     */
    public function getDefaultBranch()
    {
        return $this->defaultBranch;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getSshRepository()
    {
        return $this->sshRepository;
    }

    /**
     * @return string
     */
    public function getHttpRepository()
    {
        return $this->httpRepository;
    }

    /**
     * @return string
     */
    public function getCreateDate()
    {
        return $this->createDate;
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
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setDisplayName($val)
    {
        $this->displayName = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
}
