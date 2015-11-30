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

class CompareCommits extends Object
{
    /**
     * @var array
     */
    protected $commits;

    /**
     * @var Commit
     */
    protected $baseCommit;

    /**
     * @var int
     */
    protected $ahead;

    /**
     * @var int
     */
    protected $behind;

    /**
     * CompareCommits constructor.
     * @param array $json
     * @param array $headers
     * @param int $status
     */
    public function __construct(array $json = [], array $headers = [], $status = 200)
    {
        parent::__construct($json, $headers, $status);
        $this->setFromJsonAsArray('Buddy\Objects\Commit', 'commits');
        $this->setFromJsonAsObject('Buddy\Objects\Commit', 'baseCommit', 'base_commit');
        $this->setFromJson('ahead');
        $this->setFromJson('behind');
    }

    /**
     * @return int
     */
    public function getBehind()
    {
        return $this->behind;
    }

    /**
     * @return int
     */
    public function getAhead()
    {
        return $this->ahead;
    }

    /**
     * @return Commit
     */
    public function getBaseCommit()
    {
        return $this->baseCommit;
    }

    /**
     * @return array
     */
    public function getCommits()
    {
        return $this->commits;
    }
}
