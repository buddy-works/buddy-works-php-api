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

class Commit extends Object
{
    /**
     * @var string
     */
    protected $revision;

    /**
     * @var string
     */
    protected $authorDate;

    /**
     * @var string
     */
    protected $commitDate;

    /**
     * @var User
     */
    protected $commiter;

    /**
     * @var User
     */
    protected $author;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var ChangeStats
     */
    protected $stats;

    /**
     * @var array
     */
    protected $files;

    /**
     * @var string
     */
    protected $contentUrl;

    /**
     * @var array
     */
    protected $parents;

    /**
     * Commit constructor.
     * @param array $json
     * @param array $headers
     * @param int $status
     */
    public function __construct(array $json = [], array $headers = [], $status = 200)
    {
        parent::__construct($json, $headers, $status);
        $this->setFromJson('revision');
        $this->setFromJson('authorDate', 'author_date');
        $this->setFromJson('commitDate', 'commit_date');
        $this->setFromJsonAsObject('Buddy\Objects\User', 'commiter');
        $this->setFromJsonAsObject('Buddy\Objects\User', 'author');
        $this->setFromJson('message');
        $this->setFromJsonAsObject('Buddy\Objects\ChangeStats', 'stats');
        $this->setFromJsonAsArray('Buddy\Objects\CommitFile', 'files');
        $this->setFromJson('contentUrl', 'content_url');
        $this->setFromJsonAsArray('Buddy\Objects\Commit', 'parents');
    }

    /**
     * @return string
     */
    public function getRevision()
    {
        return $this->revision;
    }

    /**
     * @return string
     */
    public function getAuthorDate()
    {
        return $this->authorDate;
    }

    /**
     * @return string
     */
    public function getCommitDate()
    {
        return $this->commitDate;
    }

    /**
     * @return User
     */
    public function getCommiter()
    {
        return $this->commiter;
    }

    /**
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return ChangeStats
     */
    public function getStats()
    {
        return $this->stats;
    }

    /**
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @return string
     */
    public function getContentUrl()
    {
        return $this->contentUrl;
    }

    /**
     * @return array
     */
    public function getParents()
    {
        return $this->parents;
    }
}
