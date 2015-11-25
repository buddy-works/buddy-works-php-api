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

class Workspace extends Object
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $htmlUrl;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $domain;

    /**
     * @var int
     */
    private $ownerId;

    /**
     * @var bool
     */
    private $frozen;

    /**
     * @var string
     */
    private $createDate;

    /**
     * Workspace constructor.
     * @param array $json
     */
    public function __construct(array $json)
    {
        parent::__construct($json);
        $this->setFromJson('url');
        $this->setFromJson('htmlUrl', 'html_url');
        $this->setFromJson('id');
        $this->setFromJson('name');
        $this->setFromJson('domain');
        $this->setFromJson('ownerId', 'owner_id');
        $this->setFromJson('frozen');
        $this->setFromJson('createDate', 'create_date');
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getHtmlUrl()
    {
        return $this->htmlUrl;
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
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @return int
     */
    public function getOwnerId()
    {
        return $this->ownerId;
    }

    /**
     * @return bool
     */
    public function getFrozen()
    {
        return $this->frozen;
    }

    /**
     * @return string
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }
}