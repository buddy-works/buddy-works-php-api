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

use Buddy\Objects\Scenario;
use Buddy\Objects\ScenarioAction;
use Buddy\Tests\Utils;

class ScenariosTest extends \PHPUnit_Framework_TestCase
{
    public function testGetScenarios()
    {
        $project = Utils::addProject();
        $resp = Utils::getBuddy()->getApiScenarios()->getScenarios(Utils::getWorkspaceDomain(), $project->getName());
        $this->assertInstanceOf('Buddy\Objects\Scenarios', $resp);
        $this->assertInternalType('array', $resp->getScenarios());
    }

    public function testAddScenario()
    {
        $project = Utils::addProject();
        Utils::addFile($project);
        $scenario = new Scenario();
        $scenario->setName(Utils::randomString());
        $scenario->setAutomatic(true);
        $scenario->setBranch('master');
        $resp = Utils::getBuddy()->getApiScenarios()->addScenario($scenario, Utils::getWorkspaceDomain(), $project->getName());
        $this->assertInstanceOf('Buddy\Objects\Scenario', $resp);
        $this->assertEquals($scenario->getName(), $resp->getName());
        $this->assertEquals($scenario->getAutomatic(), $resp->getAutomatic());
        $this->assertEquals($scenario->getBranch(), $resp->getBranch());
        $this->assertInternalType('array', $resp->getActions());
        $this->assertNotEmpty($resp->getCreateDate());
        $this->assertInstanceOf('Buddy\Objects\User', $resp->getCreator());
        $this->assertNotEmpty($resp->getId());
        $this->assertEquals(Scenario::STATUS_INITIAL, $resp->getStatus());
        $this->assertInstanceOf('Buddy\Objects\Project', $resp->getProject());
    }

    public function testGetScenario()
    {
        $project = Utils::addProject();
        $scenario = Utils::addScenario($project);
        $resp = Utils::getBuddy()->getApiScenarios()->getScenario(Utils::getWorkspaceDomain(), $project->getName(), $scenario->getId());
        $this->assertInstanceOf('Buddy\Objects\Scenario', $resp);
        $this->assertEquals($scenario->getId(), $resp->getId());
    }

    public function testEditScenario()
    {
        $project = Utils::addProject();
        $scenario = Utils::addScenario($project);
        $editScenario = new Scenario();
        $editScenario->setName(Utils::randomString());
        $editScenario->setAutomatic(false);
        $resp = Utils::getBuddy()->getApiScenarios()->editScenario($editScenario, Utils::getWorkspaceDomain(), $project->getName(), $scenario->getId());
        $this->assertInstanceOf('Buddy\Objects\Scenario', $resp);
        $this->assertEquals($editScenario->getAutomatic(), $resp->getAutomatic());
        $this->assertEquals($editScenario->getName(), $resp->getName());
    }

    public function testDeleteScenario()
    {
        $project = Utils::addProject();
        $scenario = Utils::addScenario($project);
        $resp = Utils::getBuddy()->getApiScenarios()->deleteScenario(Utils::getWorkspaceDomain(), $project->getName(), $scenario->getId());
        $this->assertEquals(true, $resp);
    }

    public function testGetScenarioActions()
    {
        $project = Utils::addProject();
        $scenario = Utils::addScenario($project);
        $resp = Utils::getBuddy()->getApiScenarios()->getScenarioActions(Utils::getWorkspaceDomain(), $project->getName(), $scenario->getId());
        $this->assertInstanceOf('Buddy\Objects\ScenarioActions', $resp);
        $this->assertInternalType('array', $resp->getActions());
    }

    /**
     * @expectedException \Buddy\Exceptions\BuddyResponseException
     */
    public function testAddAction()
    {
        $project = Utils::addProject();
        $scenario = Utils::addScenario($project);
        $action = new ScenarioAction();
        Utils::getBuddy()->getApiScenarios()->addScenarioAction($action, Utils::getWorkspaceDomain(), $project->getName(), $scenario->getId());
    }

    /**
     * @expectedException \Buddy\Exceptions\BuddyResponseException
     */
    public function testDeleteScenarioAction()
    {
        Utils::getBuddy()->getApiScenarios()->deleteScenarioAction(Utils::getWorkspaceDomain(), 'test', 1, 1);
    }

    /**
     * @expectedException \Buddy\Exceptions\BuddyResponseException
     */
    public function testReorderScenarioActions()
    {
        Utils::getBuddy()->getApiScenarios()->reorderScenarioActions([1, 2, 3], Utils::getWorkspaceDomain(), 'test', 1);
    }

    /**
     * @expectedException \Buddy\Exceptions\BuddyResponseException
     */
    public function testEditScenarioAction()
    {
        Utils::getBuddy()->getApiScenarios()->editScenarioAction(new ScenarioAction(), Utils::getWorkspaceDomain(), 'test', 1, 1);
    }

    /**
     * @expectedException \Buddy\Exceptions\BuddyResponseException
     */
    public function testGetScenarioAction()
    {
        Utils::getBuddy()->getApiScenarios()->getScenarioAction(Utils::getWorkspaceDomain(), 'test', 1, 1);
    }

    public function testActionModel()
    {
        $name = Utils::randomString();
        $accessKey = Utils::randomString();
        $activeMode = true;
        $authMode = ScenarioAction::AUTH_MODE_PASS;
        $bucketName = Utils::randomString();
        $cloudfrontId = Utils::randomString();
        $commands = ['ls'];
        $host = 'http://google.pl';
        $localPath = '/test';
        $passphrase = Utils::randomString();
        $password = Utils::randomString();
        $login = Utils::randomString();
        $port = Utils::randomInteger();
        $publicAccess = true;
        $reducedRedundacy = true;
        $remotePath = '/var';
        $secretKey = Utils::randomString();
        $serverKey = Utils::randomString();
        $type = ScenarioAction::TYPE_SFTP;
        $workingDir = '/home';
        $action = new ScenarioAction();
        $action->setName($name);
        $action->setAccessKey($accessKey);
        $action->setActiveMode($activeMode);
        $action->setAuthenticationMode($authMode);
        $action->setBucketName($bucketName);
        $action->setCloudfrontId($cloudfrontId);
        $action->setCommands($commands);
        $action->setHost($host);
        $action->setLocalPath($localPath);
        $action->setLogin($login);
        $action->setPassphrase($passphrase);
        $action->setPassword($password);
        $action->setPort($port);
        $action->setPublicAccess($publicAccess);
        $action->setReducedRedundancy($reducedRedundacy);
        $action->setRemotePath($remotePath);
        $action->setSecretKey($secretKey);
        $action->setServerKey($serverKey);
        $action->setType($type);
        $action->setWorkingDirectory($workingDir);

        $this->assertEquals($name, $action->getName());
        $this->assertEquals($accessKey, $action->getAccessKey());
        $this->assertEquals($activeMode, $action->getActiveMode());
        $this->assertEquals($authMode, $action->getAuthenticationMode());
        $this->assertEquals($bucketName, $action->getBucketName());
        $this->assertEquals($cloudfrontId, $action->getCloudfrontId());
        $this->assertEquals($commands, $action->getCommands());
        $this->assertEquals($host, $action->getHost());
        $this->assertEquals($localPath, $action->getLocalPath());
        $this->assertEquals($login, $action->getLogin());
        $this->assertEquals($passphrase, $action->getPassphrase());
        $this->assertEquals($password, $action->getPassword());
        $this->assertEquals($port, $action->getPort());
        $this->assertEquals($publicAccess, $action->getPublicAccess());
        $this->assertEquals($reducedRedundacy, $action->getReducedRedundancy());
        $this->assertEquals($remotePath, $action->getRemotePath());
        $this->assertEquals($secretKey, $action->getSecretKey());
        $this->assertEquals($serverKey, $action->getServerKey());
        $this->assertEquals($type, $action->getType());
        $this->assertEquals($workingDir, $action->getWorkingDirectory());
        $this->assertEmpty($action->getId());
        $this->assertEmpty($action->getRevision());
        $this->assertEmpty($action->getStatus());
    }

}