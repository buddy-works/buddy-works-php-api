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

use Buddy\Exceptions\BuddyResponseException;
use Buddy\Objects\Release;
use Buddy\Tests\Utils;

class ReleasesTest extends \PHPUnit_Framework_TestCase
{
    public function testGetScenarioReleases()
    {
        $project = Utils::addProject();
        $scenario = Utils::addScenario($project);
        $resp = Utils::getBuddy()->getApiReleases()->getScenarioReleases(Utils::getWorkspaceDomain(), $project->getName(), $scenario->getId());
        $this->assertInstanceOf('Buddy\Objects\Releases', $resp);
        $this->assertInternalType('array', $resp->getReleases());
    }

    /**
     * @expectedException \Buddy\Exceptions\BuddyResponseException
     */
    public function testGetRelease()
    {
        Utils::getBuddy()->getApiReleases()->getScenarioRelease(Utils::getWorkspaceDomain(), 'test', 1, 1);
    }

    /**
     * @expectedException \Buddy\Exceptions\BuddyResponseException
     */
    public function testCancelRelease()
    {
        Utils::getBuddy()->getApiReleases()->cancelRelease(Utils::getWorkspaceDomain(), 'test', 1, 1);
    }

    /**
     * @expectedException \Buddy\Exceptions\BuddyResponseException
     */
    public function testRetryRelease()
    {
        Utils::getBuddy()->getApiReleases()->retryRelease(Utils::getWorkspaceDomain(), 'test', 1, 1);
    }
}
