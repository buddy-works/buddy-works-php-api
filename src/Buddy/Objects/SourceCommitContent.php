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

class SourceCommitContent extends Object
{
    /**
     * @var SourceContent
     */
    protected $content;

    /**
     * @var Commit
     */
    protected $commit;

    /**
     * SourceCommitContent constructor.
     * @param array $json
     * @param array $headers
     * @param int $status
     */
    public function __construct(array $json = [], array $headers = [], $status = 200)
    {
        parent::__construct($json, $headers, $status);
        $this->setFromJsonAsObject('Buddy\Objects\SourceContent', 'content');
        $this->setFromJsonAsObject('Buddy\Objects\Commit', 'commit');
    }

    /**
     * @return SourceContent
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return Commit
     */
    public function getCommit()
    {
        return $this->commit;
    }
}
