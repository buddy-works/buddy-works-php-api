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
use Buddy\Objects\SourceContent;

class Source
{
    public function getContents()
    {
        try {
            $buddy = new Buddy();
            $resp = $buddy->getApiSource()->getContents('domain', 'projectName', 'path', 'yourAccessToken');
            var_dump($resp->getContents());
            exit;

        } catch (BuddyResponseException $e) {
            echo $e->getMessage();
            exit;

        } catch (BuddySDKException $e) {
            echo $e->getMessage();
            exit;

        }
    }

    public function addFile()
    {
        try {
            $buddy = new Buddy([
                'accessToken' => 'yourAccessToken'
            ]);
            $content = new SourceContent();
            $content->setMessage('#1234 resolved');
            $content->setContent(base64_encode('var test = 1'));
            $content->setPath('test.js');
            $resp = $buddy->getApiSource()->addFile($content, 'domain', 'projectName');
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

    public function editFile()
    {
        try {
            $buddy = new Buddy([
                'accessToken' => 'yourAccessToken'
            ]);
            $content = new SourceContent();
            $content->setMessage('#4321 resolved');
            $content->setContent(base64_encode('var test = 1;'));
            $content->setBranch('master');
            $resp = $buddy->getApiSource()->editFile($content, 'domain', 'projectName', 'test.js');
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

    public function deleteFile()
    {
        try {
            $buddy = new Buddy([
                'accessToken' => 'yourAccessToken'
            ]);
            $content = new SourceContent();
            $content->setMessage('delete test');
            $content->setBranch('master');
            $resp = $buddy->getApiSource()->deleteFile($content, 'domain', 'projectName', 'test.js');
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
