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
use Buddy\Objects\Branch;
use Buddy\Objects\Commit;

class Branches
{
    public function getBranches()
    {
        try {
            $buddy = new Buddy();
            $resp = $buddy->getApiBranches()->getBranches('domain', 'projectName', 'yourAccessToken');
            var_dump($resp->getBranches());
            exit;

        } catch (BuddyResponseException $e) {
            echo $e->getMessage();
            exit;

        } catch (BuddySDKException $e) {
            echo $e->getMessage();
            exit;

        }
    }

    public function getBranch()
    {
        try {
            $buddy = new Buddy([
                'accessToken' => 'yourAccessToken'
            ]);
            $resp = $buddy->getApiBranches()->getBranch('domain', 'projectName', 'branch name');
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

    public function addBranch()
    {
        try {
            $buddy = new Buddy([
                'accessToken' => 'yourAccessToken'
            ]);
            $branch = new Branch();
            $head = new Commit();
            $head->setRevision('branch head revision');
            $branch->setName('dev');
            $branch->setCommit($head);
            $resp = $buddy->getApiBranches()->addBranch($branch, 'domain', 'projectName');
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

    public function deleteBranch()
    {
        try {
            $buddy = new Buddy([
                'accessToken' => 'yourAccessToken'
            ]);
            $resp = $buddy->getApiBranches()->deleteBranch('domain', 'projectName', 'branchName', true);
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
