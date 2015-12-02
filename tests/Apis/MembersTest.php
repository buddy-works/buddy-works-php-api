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

class MembersTest extends \PHPUnit_Framework_TestCase
{
    public function testGetMembers()
    {
        $members = Utils::getBuddy()->getApiMembers()->getWorkspaceMembers(Utils::getWorkspaceDomain());
        $this->assertInstanceOf('Buddy\Objects\Members', $members);
        $this->assertNotEmpty($members->getJson());
        $this->assertNotEmpty($members->getUrl());
        $this->assertNotEmpty($members->getHtmlUrl());
        $this->assertGreaterThan(0, count($members->getMembers()));
    }

    public function testAddMember()
    {
        $email = Utils::randomEmail();
        $user = new User();
        $user->setEmail($email);
        $newUser = Utils::getBuddy()->getApiMembers()->addWorkspaceMember($user, Utils::getWorkspaceDomain());
        $this->assertInstanceOf('Buddy\Objects\User', $newUser);
        $this->assertEquals($email, $newUser->getEmail());
    }

    public function testGetMember()
    {
        $user = Utils::addUser();
        $newUser = Utils::getBuddy()->getApiMembers()->getWorkspaceMember(Utils::getWorkspaceDomain(), $user->getId());
        $this->assertInstanceOf('Buddy\Objects\User', $newUser);
        $this->assertEquals($user->getId(), $newUser->getId());
        $this->assertEquals($user->getAdmin(), $newUser->getAdmin());
        $this->assertEquals($user->getWorkspaceOwner(), $newUser->getWorkspaceOwner());
        $this->assertEquals($user->getAvatarUrl(), $newUser->getAvatarUrl());
        $this->assertEquals($user->getEmail(), $newUser->getEmail());
        $this->assertEquals($user->getName(), $newUser->getName());
        $this->assertEquals($user->getTitle(), $newUser->getTitle());
    }

    public function testEditMember()
    {
        $user = Utils::addUser();
        $user->setAdmin(true);
        $newUser = Utils::getBuddy()->getApiMembers()->editWorkspaceMember($user, Utils::getWorkspaceDomain(), $user->getId());
        $this->assertInstanceOf('Buddy\Objects\User', $newUser);
        $this->assertEquals($user->getAdmin(), $newUser->getAdmin());
    }

    public function testDeleteMember()
    {
        $user = Utils::addUser();
        $resp = Utils::getBuddy()->getApiMembers()->deleteWorkspaceMember(Utils::getWorkspaceDomain(), $user->getId());
        $this->assertEquals(true, $resp);
    }

    public function testGetMemberProjects()
    {
        $user = Utils::addUser();
        $resp = Utils::getBuddy()->getApiMembers()->getWorkspaceMemberProjects(Utils::getWorkspaceDomain(), $user->getId());
        $this->assertInstanceOf('Buddy\Objects\Projects', $resp);
        $this->assertNotEmpty($resp->getUrl());
        $this->assertEquals(0, count($resp->getProjects()));
    }
}
