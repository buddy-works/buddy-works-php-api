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

use Buddy\Objects\CommitFile;
use Buddy\Tests\Utils;

class CommitsTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCommits()
    {
        $project = Utils::addProject();
        Utils::addFile($project);
        $resp = Utils::getBuddy()->getApiCommits()->getCommits(Utils::getWorkspaceDomain(), $project->getName());
        $this->assertInstanceOf('Buddy\Objects\Commits', $resp);
        $this->assertInternalType('array', $resp->getCommits());
        $this->assertGreaterThan(0, count($resp->getCommits()));
    }

    public function testGetCommit()
    {
        $project = Utils::addProject();
        $oldFile = Utils::addFile($project);
        $file = Utils::addFile($project);
        $commit = $file->getCommit();
        $resp = Utils::getBuddy()->getApiCommits()->getCommit(Utils::getWorkspaceDomain(), $project->getName(), $commit->getRevision());
        $this->assertInstanceOf('Buddy\Objects\Commit', $resp);
        $this->assertEquals($commit->getRevision(), $resp->getRevision());
        $this->assertEquals($commit->getAuthorDate(), $resp->getAuthorDate());
        $this->assertEquals($commit->getCommitDate(), $resp->getCommitDate());
        $this->assertNotEmpty($resp->getContentUrl());
        $this->assertEquals($commit->getMessage(), $resp->getMessage());
        $this->assertInstanceOf('Buddy\Objects\User', $resp->getAuthor());
        $this->assertInstanceOf('Buddy\Objects\User', $resp->getCommitter());
        $this->assertInternalType('array', $resp->getFiles());
        $this->assertInternalType('array', $resp->getParents());
        $this->assertInstanceOf('Buddy\Objects\ChangeStats', $resp->getStats());
        $this->assertEquals(1, $resp->getStats()->getAdditions());
        $this->assertEquals(0, $resp->getStats()->getDeletions());
        $this->assertEquals(1, $resp->getStats()->getTotal());

        /**
         * @var \Buddy\Objects\CommitFile $addedFile
         */
        $addedFile = $resp->getFiles()[0];
        $this->assertEquals($file->getContent()->getName(), $addedFile->getFileName());
        $this->assertEquals(CommitFile::STATUS_ADDED, $addedFile->getStatus());
        $this->assertGreaterThan(0, $addedFile->getAdditions());
        $this->assertEquals(0, $addedFile->getDeletions());
        $this->assertGreaterThan(0, $addedFile->getTotal());
        $this->assertNotEmpty($addedFile->getPatch());

        $this->assertEquals(1, count($resp->getParents()));

        /**
         * @var \Buddy\Objects\Commit $parent
         */
        $parent = $resp->getParents()[0];
        $this->assertEquals($oldFile->getCommit()->getRevision(), $parent->getRevision());
    }

    public function testCompare()
    {
        $project = Utils::addProject();
        $oldFile = Utils::addFile($project);
        $file = Utils::addFile($project);
        $resp = Utils::getBuddy()->getApiCommits()->getCompare(Utils::getWorkspaceDomain(), $project->getName(), $oldFile->getCommit()->getRevision(), $file->getCommit()->getRevision());
        $this->assertInstanceOf('Buddy\Objects\CompareCommits', $resp);
        $this->assertInstanceOf('Buddy\Objects\Commit', $resp->getBaseCommit());
        $this->assertInternalType('array', $resp->getCommits());
        $this->assertEquals(0, $resp->getAhead());
        $this->assertEquals(1, $resp->getBehind());
    }
}