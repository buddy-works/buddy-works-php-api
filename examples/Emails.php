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
use Buddy\Objects\Email;

class Emails
{
    public function getEmails()
    {
        try {
            $buddy = new Buddy();
            $resp = $buddy->getApiEmails()->getAuthenticatedUserEmails('yourAccessToken');
            var_dump($resp->getEmails());
            exit;

        } catch (BuddyResponseException $e) {
            echo $e->getMessage();
            exit;

        } catch (BuddySDKException $e) {
            echo $e->getMessage();
            exit;

        }
    }

    public function addEmail()
    {
        try {
            $buddy = new Buddy([
                'accessToken' => 'yourAccessToken'
            ]);
            $email = new Email();
            $email->setEmail('test2@test.com');
            $resp = $buddy->getApiEmails()->addAuthenticatedUserEmail($email);
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

    public function deleteEmail()
    {
        try {
            $buddy = new Buddy([
                'accessToken' => 'yourAccessToken'
            ]);
            $resp = $buddy->getApiEmails()->deleteAuthenticatedUserEmail('test2@test.com');
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
