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

use Buddy\Objects\SourceContent;
use Buddy\Tests\Utils;

class SourceTest extends \PHPUnit_Framework_TestCase
{
    public function testAddFile()
    {
        $base = base64_encode('Test');
        $msg = 'Test';
        $path = 'test.txt';
        $project = Utils::addProject();
        $content = new SourceContent();
        $content->setPath($path);
        $content->setMessage($msg);
        $content->setContent($base);
        $resp = Utils::getBuddy()->getApiSource()->addFile($content, Utils::getWorkspaceDomain(), $project->getName());
        $this->assertInstanceOf('Buddy\Objects\SourceCommitContent', $resp);
        $this->assertInstanceOf('Buddy\Objects\Commit', $resp->getCommit());
        $this->assertInstanceOf('Buddy\Objects\SourceContent', $resp->getContent());
        $this->assertEquals($base, $resp->getContent()->getContent());
        $this->assertEquals($msg, $resp->getCommit()->getMessage());
        $this->assertEquals($path, $resp->getContent()->getName());
        $this->assertEquals($path, $resp->getContent()->getPath());
        $this->assertGreaterThan(0, $resp->getContent()->getSize());
        $this->assertEquals(SourceContent::CONTENT_TYPE_FILE, $resp->getContent()->getContentType());
        $this->assertEquals(SourceContent::ENCODING_BASE64, $resp->getContent()->getEncoding());
    }

    public function testGetContents()
    {
        $project = Utils::addProject();
        Utils::addFile($project);
        $resp = Utils::getBuddy()->getApiSource()->getContents(Utils::getWorkspaceDomain(), $project->getName());
        $this->assertInstanceOf('Buddy\Objects\SourceContents', $resp);
        $this->assertInternalType('array', $resp->getContents());
        $this->assertEquals(1, count($resp->getContents()));
    }

    public function testEditFile()
    {
        $project = Utils::addProject();
        $content = Utils::addFile($project);

        $newFile = new SourceContent();
        $newFile->setMessage('ABC');
        $newFile->setContent(base64_encode('New content'));

        $resp = Utils::getBuddy()->getApiSource()->editFile($newFile, Utils::getWorkspaceDomain(), $project->getName(), $content->getContent()->getPath());

        $this->assertInstanceOf('Buddy\Objects\SourceCommitContent', $resp);
        $this->assertInstanceOf('Buddy\Objects\Commit', $resp->getCommit());
        $this->assertInstanceOf('Buddy\Objects\SourceContent', $resp->getContent());
        $this->assertEquals($newFile->getContent(), $resp->getContent()->getContent());
        $this->assertEquals($newFile->getMessage(), $resp->getCommit()->getMessage());
        $this->assertEquals($content->getContent()->getName(), $resp->getContent()->getName());
        $this->assertEquals($content->getContent()->getPath(), $resp->getContent()->getPath());
        $this->assertGreaterThan(0, $resp->getContent()->getSize());
        $this->assertEquals(SourceContent::CONTENT_TYPE_FILE, $resp->getContent()->getContentType());
        $this->assertEquals(SourceContent::ENCODING_BASE64, $resp->getContent()->getEncoding());
    }

    public function testDeleteFile()
    {
        $project = Utils::addProject();
        $content = Utils::addFile($project);

        $delFile = new SourceContent();
        $delFile->setMessage('AAA');
        $delFile->setBranch($content->getContent()->getBranch());

        $resp = Utils::getBuddy()->getApiSource()->deleteFile($delFile, Utils::getWorkspaceDomain(), $project->getName(), $content->getContent()->getPath());

        $this->assertInstanceOf('Buddy\Objects\Commit', $resp);
    }
}
