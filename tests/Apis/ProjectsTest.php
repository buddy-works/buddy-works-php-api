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

use Buddy\Objects\Project;
use Buddy\Objects\User;
use Buddy\Tests\Utils;

class ProjectsTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateProjectOnlyName()
    {
        $name = Utils::randomString();
        $project = new Project();
        $project->setName($name);
        $project = Utils::getBuddy()->getApiProjects()->addProject($project, Utils::getWorkspaceDomain());
        $this->assertInstanceOf('Buddy\Objects\Project', $project);
        $this->assertEquals($name, $project->getName());
        $this->assertEquals('ACTIVE', $project->getStatus());
    }

    public function testCreateProject()
    {
        $name = Utils::randomString();
        $displayName = Utils::randomString();
        $project = new Project();
        $project->setName($name);
        $project->setDisplayName($displayName);
        $project = Utils::getBuddy()->getApiProjects()->addProject($project, Utils::getWorkspaceDomain());
        $this->assertInstanceOf('Buddy\Objects\Project', $project);
        $this->assertEquals($name, $project->getName());
        $this->assertEquals('ACTIVE', $project->getStatus());
        $this->assertEquals($displayName, $project->getDisplayName());
        $this->assertEquals('master', $project->getDefaultBranch());
        $this->assertEquals(0, $project->getSize());
        $this->assertNotEmpty($project->getHttpRepository());
        $this->assertNotEmpty($project->getSshRepository());
        $this->assertNotEmpty($project->getCreateDate());
        $this->assertInstanceOf('Buddy\Objects\User', $project->getCreatedBy());
    }

    public function testGetProjects()
    {
        $resp = Utils::getBuddy()->getApiProjects()->getProjects(Utils::getWorkspaceDomain());
        $this->assertNotEmpty($resp->getJson());
        $this->assertNotEmpty($resp->getHtmlUrl());
        $this->assertNotEmpty($resp->getUrl());
        $this->assertGreaterThan(0, count($resp->getProjects()));
    }

    public function testGetProject()
    {
        $project = Utils::addProject();
        $resp = Utils::getBuddy()->getApiProjects()->getProject(Utils::getWorkspaceDomain(), $project->getName());
        $this->assertEquals($project->getName(), $resp->getName());
        $this->assertEquals($project->getUrl(), $resp->getUrl());
        $this->assertEquals($project->getHtmlUrl(), $resp->getHtmlUrl());
        $this->assertEquals($project->getDisplayName(), $resp->getDisplayName());
        $this->assertEquals($project->getStatus(), $resp->getStatus());
    }

    /**
     * @expectedException \Buddy\Exceptions\BuddyResponseException
     * @expectedExceptionMessage Missed project with id: zxcasdqwe123
     */
    public function testGetProjectNotExistent()
    {
        Utils::getBuddy()->getApiProjects()->getProject(Utils::getWorkspaceDomain(), 'zxcasdqwe123');
    }

    public function testEditProject()
    {
        $project = Utils::addProject();
        $editProject = new Project();
        $editProject->setName(Utils::randomString())
            ->setDisplayName(Utils::randomString());
        $savedProject = Utils::getBuddy()->getApiProjects()->editProject($editProject, Utils::getWorkspaceDomain(), $project->getName());
        $this->assertEquals($editProject->getName(), $savedProject->getName());
        $this->assertEquals($editProject->getDisplayName(), $savedProject->getDisplayName());
    }

    public function testEditProjectWithoutName()
    {
        $project = Utils::addProject();
        $editProject = new Project();
        $editProject->setDisplayName(Utils::randomString());
        $savedProject = Utils::getBuddy()->getApiProjects()->editProject($editProject, Utils::getWorkspaceDomain(), $project->getName());
        $this->assertEquals($project->getName(), $savedProject->getName());
        $this->assertEquals($editProject->getDisplayName(), $savedProject->getDisplayName());
    }

    public function testEditProjectWithoutDisplayName()
    {
        $project = Utils::addProject();
        $editProject = new Project();
        $editProject->setName(Utils::randomString());
        $savedProject = Utils::getBuddy()->getApiProjects()->editProject($editProject, Utils::getWorkspaceDomain(), $project->getName());
        $this->assertEquals($editProject->getName(), $savedProject->getName());
        $this->assertEquals($project->getDisplayName(), $savedProject->getDisplayName());
    }

    public function testDeleteProject()
    {
        $project = Utils::addProject();
        $resp = Utils::getBuddy()->getApiProjects()->deleteProject(Utils::getWorkspaceDomain(), $project->getName());
        $this->assertEquals(true, $resp);
    }

    public function testGetProjectMembers()
    {
        $project = Utils::addProject();
        $resp = Utils::getBuddy()->getApiProjects()->getProjectMembers(Utils::getWorkspaceDomain(), $project->getName());
        $this->assertNotEmpty($resp->getJson());
        $this->assertNotEmpty($resp->getHtmlUrl());
        $this->assertNotEmpty($resp->getUrl());
        $this->assertInternalType('array', $resp->getMembers());
    }

    public function testAddProjectMember()
    {
        $project = Utils::addProject();
        $user = Utils::addUser();
        $perm = Utils::addPermission();
        $user->setPermissionSet($perm);
        $resp = Utils::getBuddy()->getApiProjects()->addProjectMember($user, Utils::getWorkspaceDomain(), $project->getName());
        $this->assertInstanceOf('Buddy\Objects\User', $resp);
        $this->assertEquals($user->getId(), $resp->getId());
    }

    public function testGetProjectMember()
    {
        $project = Utils::addProject();
        $user = Utils::addUser();
        Utils::addUser2Project($project, $user);
        $resp = Utils::getBuddy()->getApiProjects()->getProjectMember(Utils::getWorkspaceDomain(), $project->getName(), $user->getId());
        $this->assertInstanceOf('Buddy\Objects\User', $resp);
        $this->assertEquals($user->getId(), $resp->getId());
    }

    public function testDeleteProjectMember()
    {
        $project = Utils::addProject();
        $user = Utils::addUser();
        Utils::addUser2Project($project, $user);
        $resp = Utils::getBuddy()->getApiProjects()->deleteProjectMember(Utils::getWorkspaceDomain(), $project->getName(), $user->getId());
        $this->assertEquals(true, $resp);
    }

    public function testEditProjectMember()
    {
        $project = Utils::addProject();
        $user = Utils::addUser();
        Utils::addUser2Project($project, $user);
        $user->setPermissionSet(Utils::addPermission());
        $resp = Utils::getBuddy()->getApiProjects()->editProjectMember($user, Utils::getWorkspaceDomain(), $project->getName(), $user->getId());
        $this->assertInstanceOf('Buddy\Objects\User', $resp);
        $this->assertEquals($user->getPermissionSet()->getId(), $resp->getPermissionSet()->getId());
    }

    /**
     * @expectedException \Buddy\Exceptions\BuddySDKException
     * @expectedExceptionMessage PermissionSet must be set
     */
    public function testEditProjectMemberWithoutPermission()
    {
        Utils::getBuddy()->getApiProjects()->editProjectMember(new User(), Utils::getWorkspaceDomain(), 'test', 1);
    }

    /**
     * @expectedException \Buddy\Exceptions\BuddySDKException
     * @expectedExceptionMessage PermissionSet must be set
     */
    public function testAddProjectMemberWithoutPermission()
    {
        Utils::getBuddy()->getApiProjects()->addProjectMember(new User(), Utils::getWorkspaceDomain(), 'test');
    }
}