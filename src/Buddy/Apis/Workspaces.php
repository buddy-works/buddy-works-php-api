<?php

declare(strict_types=1);
/**
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at.
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
     * @param string|null $accessToken
     *
     * @throws \Buddy\Exceptions\BuddySDKException
     *
     * @return \Buddy\BuddyResponse
     */
    public function getWorkspaces($accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces');
    }

    /**
     * @param string      $domain
     * @param string|null $accessToken
     *
     * @return \Buddy\BuddyResponse
     */
    public function getWorkspace($domain, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain', [
            'domain' => $domain,
        ]);
    }
}
