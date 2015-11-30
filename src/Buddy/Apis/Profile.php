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

use Buddy\Objects\User;

class Profile extends Api
{
    /**
     * @param null|string $accessToken
     * @return \Buddy\Objects\User
     */
    public function getAuthenticatedUser($accessToken = null)
    {
        return $this->getJson($accessToken, '/user')->getAsUser();
    }

    /**
     * @param User $user
     * @param null|string $accessToken
     * @return User
     */
    public function editAuthenticatedUser(User $user, $accessToken = null)
    {
        return $this->patchJson($accessToken, [
            'name' => $user->getName(),
            'title' => $user->getTitle(),

        ], '/user')->getAsUser();
    }
}
