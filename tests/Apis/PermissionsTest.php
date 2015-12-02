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


use Buddy\Objects\PermissionSet;
use Buddy\Tests\Utils;

class PermissionsTest extends \PHPUnit_Framework_TestCase
{
    public function testGetPermissions()
    {
        $resp = Utils::getBuddy()->getApiPermissions()->getWorkspacePermissions(Utils::getWorkspaceDomain());
        $this->assertInstanceOf('Buddy\Objects\PermissionSets', $resp);
        $this->assertNotEmpty($resp->getHtmlUrl());
        $this->assertNotEmpty($resp->getUrl());
        $this->assertGreaterThan(0, count($resp->getPermissionSets()));
    }

    public function testAddPermission()
    {
        $perm = new PermissionSet();
        $perm->setName(Utils::randomString());
        $perm->setDescription(Utils::randomString());
        $perm->setRepositoryAccessLevel(PermissionSet::REPOSITORY_ACCESS_LEVEL_READ_WRITE);
        $perm->setReleaseScenarioAccessLevel(PermissionSet::RELEASE_SCENARIO_ACCESS_LEVEL_READ_WRITE);
        $resp = Utils::getBuddy()->getApiPermissions()->addWorkspacePermission($perm, Utils::getWorkspaceDomain());
        $this->assertInstanceOf('Buddy\Objects\PermissionSet', $resp);
        $this->assertEquals($perm->getName(), $resp->getName());
        $this->assertEquals($perm->getDescription(), $resp->getDescription());
        $this->assertEquals($perm->getRepositoryAccessLevel(), $resp->getRepositoryAccessLevel());
        $this->assertEquals($perm->getReleaseScenarioAccessLevel(), $resp->getReleaseScenarioAccessLevel());
        $this->assertEquals(PermissionSet::TYPE_CUSTOM, $resp->getType());
        $this->assertNotEmpty($resp->getHtmlUrl());
        $this->assertNotEmpty($resp->getId());
        $this->assertNotEmpty($resp->getUrl());
    }

    public function testGetPermission()
    {
        $perm = Utils::addPermission();
        $resp = Utils::getBuddy()->getApiPermissions()->getWorkspacePermission(Utils::getWorkspaceDomain(), $perm->getId());
        $this->assertInstanceOf('Buddy\Objects\PermissionSet', $resp);
        $this->assertEquals($perm->getHtmlUrl(), $resp->getHtmlUrl());
        $this->assertEquals($perm->getId(), $resp->getId());
        $this->assertEquals($perm->getUrl(), $resp->getUrl());
        $this->assertEquals($perm->getDescription(), $resp->getDescription());
        $this->assertEquals($perm->getName(), $resp->getName());
        $this->assertEquals($perm->getReleaseScenarioAccessLevel(), $resp->getReleaseScenarioAccessLevel());
        $this->assertEquals($perm->getRepositoryAccessLevel(), $resp->getRepositoryAccessLevel());
        $this->assertEquals($perm->getType(), $resp->getType());
    }

    public function testEditPermission()
    {
        $perm = Utils::addPermission();
        $perm->setDescription(Utils::randomString())
            ->setName(Utils::randomString())
            ->setRepositoryAccessLevel(PermissionSet::REPOSITORY_ACCESS_LEVEL_DENIED)
            ->setReleaseScenarioAccessLevel(PermissionSet::RELEASE_SCENARIO_ACCESS_LEVEL_DENIED);
        $resp = Utils::getBuddy()->getApiPermissions()->editWorkspacePermission($perm, Utils::getWorkspaceDomain(), $perm->getId());
        $this->assertInstanceOf('Buddy\Objects\PermissionSet', $resp);
        $this->assertEquals($perm->getHtmlUrl(), $resp->getHtmlUrl());
        $this->assertEquals($perm->getId(), $resp->getId());
        $this->assertEquals($perm->getUrl(), $resp->getUrl());
        $this->assertEquals($perm->getDescription(), $resp->getDescription());
        $this->assertEquals($perm->getName(), $resp->getName());
        $this->assertEquals($perm->getReleaseScenarioAccessLevel(), $resp->getReleaseScenarioAccessLevel());
        $this->assertEquals($perm->getRepositoryAccessLevel(), $resp->getRepositoryAccessLevel());
        $this->assertEquals($perm->getType(), $resp->getType());
    }

    public function testEditPermisisonOnlyName()
    {
        $perm = Utils::addPermission();
        $newPerm = new PermissionSet();
        $newPerm->setName(Utils::randomString());
        $resp = Utils::getBuddy()->getApiPermissions()->editWorkspacePermission($newPerm, Utils::getWorkspaceDomain(), $perm->getId());
        $this->assertInstanceOf('Buddy\Objects\PermissionSet', $resp);
        $this->assertEquals($perm->getHtmlUrl(), $resp->getHtmlUrl());
        $this->assertEquals($perm->getId(), $resp->getId());
        $this->assertEquals($perm->getUrl(), $resp->getUrl());
        $this->assertEquals($perm->getDescription(), $resp->getDescription());
        $this->assertEquals($newPerm->getName(), $resp->getName());
        $this->assertEquals($perm->getReleaseScenarioAccessLevel(), $resp->getReleaseScenarioAccessLevel());
        $this->assertEquals($perm->getRepositoryAccessLevel(), $resp->getRepositoryAccessLevel());
        $this->assertEquals($perm->getType(), $resp->getType());
    }

    public function testDeletePermission()
    {
        $perm = Utils::addPermission();
        $resp = Utils::getBuddy()->getApiPermissions()->deleteWorkspacePermission(Utils::getWorkspaceDomain(), $perm->getId());
        $this->assertEquals(true, $resp);
    }
}
