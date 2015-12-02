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

use Buddy\Objects\Tag;
use Buddy\Tests\Utils;

class TagsTest extends \PHPUnit_Framework_TestCase
{
    public function testGetTags()
    {
        $project = Utils::addProject();
        $resp = Utils::getBuddy()->getApiTags()->getTags(Utils::getWorkspaceDomain(), $project->getName());
        $this->assertInstanceOf('Buddy\Objects\Tags', $resp);
        $this->assertInternalType('array', $resp->getTags());
    }

    /**
     * @expectedException \Buddy\Exceptions\BuddyResponseException
     */
    public function testGetTag()
    {
        $project = Utils::addProject();
        Utils::getBuddy()->getApiTags()->getTag(Utils::getWorkspaceDomain(), $project->getName(), 'test');
    }

    public function testTagModel()
    {
        $json = [
            'url' => 'https://api.buddy.works/workspaces/acme/projects/company-website/repository/tags/m4',
            'name' => 'm4',
            'commit' => [
                'revision' => '6685756c7ed4fe63df75c24894215f4a29849588'
            ]
        ];
        $tag = new Tag($json);
        $this->assertEquals($json['name'], $tag->getName());
        $this->assertInstanceOf('Buddy\Objects\Commit', $tag->getCommit());
    }
}
