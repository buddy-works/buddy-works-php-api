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

namespace Buddy\Apis;

class Tags extends Api
{
    /**
     * @param string $domain
     * @param string $projectName
     * @param null|string $accessToken
     * @return \Buddy\Objects\Tags
     */
    public function getTags($domain, $projectName, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/repository/tags', [
            'domain' => $domain,
            'project_name' => $projectName
        ])->getAsTags();
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param string $name
     * @param null|string $accessToken
     * @return \Buddy\Objects\Tag
     */
    public function getTag($domain, $projectName, $name, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/repository/tags/:name', [
            'domain' => $domain,
            'project_name' => $projectName,
            'name' => $name
        ])->getAsTag();
    }
}
