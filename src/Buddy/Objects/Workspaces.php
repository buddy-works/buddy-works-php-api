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

class Workspaces extends Object
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
     * @var array
     */
    private $workspaces;

    /**
     * Workspaces constructor.
     * @param array $json
     */
    public function __construct(array $json)
    {
        parent::__construct($json);
        $this->setFromJson('url');
        $this->setFromJson('htmlUrl', 'html_url');
        $this->setFromJsonAsArray('Buddy\Objects\Workspace', 'workspaces');
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
     * @return array
     */
    public function getWorkspaces()
    {
        return $this->workspaces;
    }
}