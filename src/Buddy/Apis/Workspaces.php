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

class Workspaces extends Api
{
    /**
     * @param null|string $accessToken
     * @return \Buddy\Objects\Workspaces
     * @throws \Buddy\Exceptions\BuddySDKException
     */
    public function getWorkspaces($accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces')->getAsWorkspaces();
    }

    /**
     * @param string $domain
     * @param null|string $accessToken
     * @return \Buddy\Objects\Workspace
     */
    public function getWorkspace($domain, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain', [
            'domain' => $domain
        ])->getAsWorkspace();
    }
}
