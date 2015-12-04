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

namespace Buddy\Examples;

use Buddy\Buddy;
use Buddy\Exceptions\BuddyResponseException;
use Buddy\Exceptions\BuddySDKException;
use Buddy\Objects\Group;
use Buddy\Objects\User;

class Groups
{
    public function getGroups()
    {
        try {
            $buddy = new Buddy();
            $resp = $buddy->getApiGroups()->getGroups('domain', 'yourAccessToken');
            var_dump($resp->getGroups());
            exit;

        } catch (BuddyResponseException $e) {
            echo $e->getMessage();
            exit;

        } catch (BuddySDKException $e) {
            echo $e->getMessage();
            exit;

        }
    }

    public function addGroup()
    {
        try {
            $buddy = new Buddy([
                'accessToken' => 'yourAccessToken'
            ]);
            $group = new Group();
            $group->setName('group name');
            $group->setDescription('group desc');
            $resp = $buddy->getApiGroups()->addGroup($group, 'domain');
            var_dump($resp);
            exit;

        } catch (BuddyResponseException $e) {
            echo $e->getMessage();
            exit;

        } catch (BuddySDKException $e) {
            echo $e->getMessage();
            exit;

        }
    }

    public function getGroup()
    {
        try {
            $buddy = new Buddy([
                'accessToken' => 'yourAccessToken'
            ]);
            $resp = $buddy->getApiGroups()->getGroup('domain', 1);
            var_dump($resp);
            exit;

        } catch (BuddyResponseException $e) {
            echo $e->getMessage();
            exit;

        } catch (BuddySDKException $e) {
            echo $e->getMessage();
            exit;

        }
    }

    public function editGroup()
    {
        try {
            $buddy = new Buddy([
                'accessToken' => 'yourAccessToken'
            ]);
            $group = new Group();
            $group->setName('new name');
            $resp = $buddy->getApiGroups()->editGroup($group, 'domain', 1);
            var_dump($resp);
            exit;

        } catch (BuddyResponseException $e) {
            echo $e->getMessage();
            exit;

        } catch (BuddySDKException $e) {
            echo $e->getMessage();
            exit;

        }
    }

    public function deleteGroup()
    {
        try {
            $buddy = new Buddy([
                'accessToken' => 'yourAccessToken'
            ]);
            $resp = $buddy->getApiGroups()->deleteGroup('domain', 1);
            var_dump($resp);
            exit;

        } catch (BuddyResponseException $e) {
            echo $e->getMessage();
            exit;

        } catch (BuddySDKException $e) {
            echo $e->getMessage();
            exit;

        }
    }

    public function getGroupMembers()
    {
        try {
            $buddy = new Buddy([
                'accessToken' => 'yourAccessToken'
            ]);
            $resp = $buddy->getApiGroups()->getGroupMembers('domain', 1);
            var_dump($resp);
            exit;

        } catch (BuddyResponseException $e) {
            echo $e->getMessage();
            exit;

        } catch (BuddySDKException $e) {
            echo $e->getMessage();
            exit;

        }
    }

    public function addGroupMember()
    {
        try {
            $buddy = new Buddy([
                'accessToken' => 'yourAccessToken'
            ]);
            $user = new User();
            $user->setId(2);
            $resp = $buddy->getApiGroups()->addGroupMember($user, 'domain', 1);
            var_dump($resp);
            exit;

        } catch (BuddyResponseException $e) {
            echo $e->getMessage();
            exit;

        } catch (BuddySDKException $e) {
            echo $e->getMessage();
            exit;

        }
    }

    public function getGroupMember()
    {
        try {
            $buddy = new Buddy([
                'accessToken' => 'yourAccessToken'
            ]);
            $resp = $buddy->getApiGroups()->getGroupMember('domain', 1, 2);
            var_dump($resp);
            exit;

        } catch (BuddyResponseException $e) {
            echo $e->getMessage();
            exit;

        } catch (BuddySDKException $e) {
            echo $e->getMessage();
            exit;

        }
    }

    public function deleteGroupMember()
    {
        try {
            $buddy = new Buddy([
                'accessToken' => 'yourAccessToken'
            ]);
            $resp = $buddy->getApiGroups()->deleteGroupMember('domain', 1, 2);
            var_dump($resp);
            exit;

        } catch (BuddyResponseException $e) {
            echo $e->getMessage();
            exit;

        } catch (BuddySDKException $e) {
            echo $e->getMessage();
            exit;

        }
    }
}
