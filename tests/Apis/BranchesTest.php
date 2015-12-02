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

use Buddy\Objects\Branch;
use Buddy\Tests\Utils;

class BranchesTest extends \PHPUnit_Framework_TestCase
{
    public function testGetBranches()
    {
        $project = Utils::addProject();
        Utils::addFile($project);
        $resp = Utils::getBuddy()->getApiBranches()->getBranches(Utils::getWorkspaceDomain(), $project->getName());
        $this->assertInstanceOf('Buddy\Objects\Branches', $resp);
        $this->assertInternalType('array', $resp->getBranches());
    }

    public function testAddBranch()
    {
        $project = Utils::addProject();
        $file = Utils::addFile($project);
        $branch = new Branch();
        $branch->setName(Utils::randomString());
        $branch->setCommit($file->getCommit());
        $resp = Utils::getBuddy()->getApiBranches()->addBranch($branch, Utils::getWorkspaceDomain(), $project->getName());
        $this->assertInstanceOf('Buddy\Objects\Branch', $resp);
        $this->assertEquals($branch->getName(), $resp->getName());
        $this->assertEquals('', $resp->getDescription());
        $this->assertEquals(false, $resp->getDefault());
        $this->assertInstanceOf('Buddy\Objects\Commit', $resp->getCommit());
    }

    /**
     * @expectedException \Buddy\Exceptions\BuddySDKException
     * @expectedExceptionMessage Commit with revision must be provided
     */
    public function testAddBranchException()
    {
        $project = Utils::addProject();
        $branch = new Branch();
        $branch->setName(Utils::randomString());
        Utils::getBuddy()->getApiBranches()->addBranch($branch, Utils::getWorkspaceDomain(), $project->getName());
    }

    public function testGetBranch()
    {
        $project = Utils::addProject();
        Utils::addFile($project);
        $resp = Utils::getBuddy()->getApiBranches()->getBranch(Utils::getWorkspaceDomain(), $project->getName(), 'master');
        $this->assertInstanceOf('Buddy\Objects\Branch', $resp);
    }

    public function testDeleteBranch()
    {
        $project = Utils::addProject();
        $file = Utils::addFile($project);
        $branch = new Branch();
        $branch->setName(Utils::randomString());
        $branch->setCommit($file->getCommit());
        $branch = Utils::getBuddy()->getApiBranches()->addBranch($branch, Utils::getWorkspaceDomain(), $project->getName());
        $resp = Utils::getBuddy()->getApiBranches()->deleteBranch(Utils::getWorkspaceDomain(), $project->getName(), $branch->getName());
        $this->assertEquals(true, $resp);
    }
}
