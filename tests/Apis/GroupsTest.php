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

use Buddy\Objects\Group;
use Buddy\Tests\Utils;

class GroupsTest extends \PHPUnit_Framework_TestCase
{
    public function testAddGroup()
    {
        $group = new Group();
        $group->setName(Utils::randomString());
        $group->setDescription(Utils::randomString());
        $resp = Utils::getBuddy()->getApiGroups()->addGroup($group, Utils::getWorkspaceDomain());
        $this->assertInstanceOf('Buddy\Objects\Group', $resp);
        $this->assertEquals($group->getName(), $resp->getName());
        $this->assertEquals($group->getDescription(), $resp->getDescription());
        $this->assertNotEmpty($resp->getId());
        $this->assertNotEmpty($resp->getUrl());
        $this->assertNotEmpty($resp->getHtmlUrl());
    }

    public function testGetGroups()
    {
        Utils::addGroup();
        $resp = Utils::getBuddy()->getApiGroups()->getGroups(Utils::getWorkspaceDomain());
        $this->assertInstanceOf('Buddy\Objects\Groups', $resp);
        $this->assertNotEmpty($resp->getHtmlUrl());
        $this->assertNotEmpty($resp->getUrl());
        $this->assertGreaterThanOrEqual(1, count($resp->getGroups()));
    }

    public function testGetGroup()
    {
        $group = Utils::addGroup();
        $resp = Utils::getBuddy()->getApiGroups()->getGroup(Utils::getWorkspaceDomain(), $group->getId());
        $this->assertInstanceOf('Buddy\Objects\Group', $resp);
        $this->assertEquals($group->getId(), $resp->getId());
        $this->assertEquals($group->getName(), $resp->getName());
        $this->assertEquals($group->getDescription(), $resp->getDescription());
    }

    public function testEditGroup()
    {
        $group = Utils::addGroup();
        $group->setDescription(Utils::randomString());
        $group->setName(Utils::randomString());
        $resp = Utils::getBuddy()->getApiGroups()->editGroup($group, Utils::getWorkspaceDomain(), $group->getId());
        $this->assertInstanceOf('Buddy\Objects\Group', $resp);
        $this->assertEquals($group->getId(), $resp->getId());
        $this->assertEquals($group->getName(), $resp->getName());
        $this->assertEquals($group->getDescription(), $resp->getDescription());
    }

    public function testEditGroupOnlyName()
    {
        $group = Utils::addGroup();
        $newGroup = new Group();
        $newGroup->setName(Utils::randomString());
        $resp = Utils::getBuddy()->getApiGroups()->editGroup($newGroup, Utils::getWorkspaceDomain(), $group->getId());
        $this->assertInstanceOf('Buddy\Objects\Group', $resp);
        $this->assertEquals($group->getId(), $resp->getId());
        $this->assertEquals($newGroup->getName(), $resp->getName());
        $this->assertEquals($group->getDescription(), $resp->getDescription());
    }

    public function testDeleteGroup()
    {
        $group = Utils::addGroup();
        $resp = Utils::getBuddy()->getApiGroups()->deleteGroup(Utils::getWorkspaceDomain(), $group->getId());
        $this->assertEquals(true, $resp);
    }

    public function testAddGroupMember()
    {
        $group = Utils::addGroup();
        $user = Utils::addUser();
        $resp = Utils::getBuddy()->getApiGroups()->addGroupMember($user, Utils::getWorkspaceDomain(), $group->getId());
        $this->assertInstanceOf('Buddy\Objects\User', $resp);
        $this->assertEquals($user->getId(), $resp->getId());
    }

    public function testGetGroupMembers()
    {
        $group = Utils::addGroup();
        $user = Utils::addUser();
        Utils::addUser2Group($group, $user);
        $resp = Utils::getBuddy()->getApiGroups()->getGroupMembers(Utils::getWorkspaceDomain(), $group->getId());
        $this->assertInstanceOf('Buddy\Objects\Members', $resp);
        $this->assertGreaterThan(0, count($resp->getMembers()));
    }

    public function testGetGroupMember()
    {
        $group = Utils::addGroup();
        $user = Utils::addUser();
        Utils::addUser2Group($group, $user);
        $resp = Utils::getBuddy()->getApiGroups()->getGroupMember(Utils::getWorkspaceDomain(), $group->getId(), $user->getId());
        $this->assertInstanceOf('Buddy\Objects\User', $resp);
        $this->assertEquals($user->getId(), $resp->getId());
    }

    public function testDeleteGroupMember()
    {
        $group = Utils::addGroup();
        $user = Utils::addUser();
        Utils::addUser2Group($group, $user);
        $resp = Utils::getBuddy()->getApiGroups()->deleteGroupMember(Utils::getWorkspaceDomain(), $group->getId(), $user->getId());
        $this->assertEquals(true, $resp);
    }
}