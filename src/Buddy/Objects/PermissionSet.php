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

class PermissionSet extends Object
{
    const REPOSITORY_ACCESS_LEVEL_DENIED = 'DENIED';
    const REPOSITORY_ACCESS_LEVEL_READ_ONLY = 'READ_ONLY';
    const REPOSITORY_ACCESS_LEVEL_READ_WRITE = 'READ_WRITE';

    const RELEASE_SCENARIO_ACCESS_LEVEL_DENIED = 'DENIED';
    const RELEASE_SCENARIO_ACCESS_LEVEL_READ_ONLY = 'READ_ONLY';
    const RELEASE_SCENARIO_ACCESS_LEVEL_RUN_ONLY = 'RUN_ONLY';
    const RELEASE_SCENARIO_ACCESS_LEVEL_READ_WRITE = 'READ_WRITE';

    const TYPE_CUSTOM = 'CUSTOM';
    const TYPE_DEVELOPER = 'DEVELOPER';
    const TYPE_READ_ONLY = 'READ_ONLY';

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
    protected $description;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $repositoryAccessLevel;

    /**
     * @var string
     */
    protected $releaseScenarioAccessLevel;

    /**
     * PermissionSet constructor.
     * @param array $json
     * @param array $headers
     * @param int $status
     */
    public function __construct(array $json = [], array $headers = [], $status = 200)
    {
        parent::__construct($json, $headers, $status);
        $this->setFromJson('id');
        $this->setFromJson('name');
        $this->setFromJson('description');
        $this->setFromJson('type');
        $this->setFromJson('repositoryAccessLevel', 'repository_access_level');
        $this->setFromJson('releaseScenarioAccessLevel', 'release_scenario_access_level');
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $val
     * @return $this
     */
    public function setId($val)
    {
        $this->id = $val;
        return $this;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setDescription($val)
    {
        $this->description = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getRepositoryAccessLevel()
    {
        return $this->repositoryAccessLevel;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setRepositoryAccessLevel($val)
    {
        $this->repositoryAccessLevel = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getReleaseScenarioAccessLevel()
    {
        return $this->releaseScenarioAccessLevel;
    }

    /**
     * @param string $val
     * @return $this
     */
    public function setReleaseScenarioAccessLevel($val)
    {
        $this->releaseScenarioAccessLevel = $val;
        return $this;
    }
}
