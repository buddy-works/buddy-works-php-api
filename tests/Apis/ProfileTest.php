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

namespace Buddy\Tests\Apis;

use Buddy\Objects\User;
use Buddy\Tests\Utils;

class ProfileTest extends \PHPUnit_Framework_TestCase
{
    public function testGetUser()
    {
        $resp  = Utils::getBuddy()->getApiProfile()->getAuthenticatedUser();
        $this->assertInstanceOf('Buddy\Objects\User', $resp);

    }

    public function testUpdateUser()
    {
        $user = new User();
        $user->setTitle(Utils::randomString());
        $user->setName(Utils::randomString());
        $resp = Utils::getBuddy()->getApiProfile()->editAuthenticatedUser($user);
        $this->assertInstanceOf('Buddy\Objects\User', $resp);
        $this->assertEquals($user->getName(), $resp->getName());
        $this->assertEquals($user->getTitle(), $resp->getTitle());
    }
}
