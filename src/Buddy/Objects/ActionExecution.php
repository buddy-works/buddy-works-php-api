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

class ActionExecution extends Object
{
    const STATUS_INPROGRESS = 'INPROGRESS';
    const STATUS_ENQUEUED = 'ENQUEUED';
    const STATUS_TERMINATED = 'TERMINATED';
    const STATUS_SUCCESSFUL = 'SUCCESSFUL';
    const STATUS_FAILED = 'FAILED';
    const STATUS_INITIAL = 'INITIAL';

    /**
     * @var string
     */
    protected $fromRevision;

    /**
     * @var string
     */
    protected $toRevision;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var float
     */
    protected $progress;

    /**
     * @var ScenarioAction
     */
    protected $action;

    /**
     * ActionExecution constructor.
     * @param array $json
     * @param array $headers
     * @param int $status
     */
    public function __construct(array $json = [], array $headers = [], $status = 200)
    {
        parent::__construct($json, $headers, $status);
        $this->setFromJson('toRevision', 'to_revision');
        $this->setFromJson('fromRevision', 'from_revision');
        $this->setFromJson('status');
        $this->setFromJson('progress');
        $this->setFromJsonAsObject('Buddy\Objects\ScenarioAction', 'action');
    }

    /**
     * @return string
     */
    public function getFromRevision()
    {
        return $this->fromRevision;
    }

    /**
     * @return string
     */
    public function getToRevision()
    {
        return $this->toRevision;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return float
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * @return ScenarioAction
     */
    public function getAction()
    {
        return $this->action;
    }
}
