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

namespace Buddy\Tests;

use Buddy\Buddy;
use Buddy\Exceptions\BuddySDKException;
use Buddy\Objects\Group;
use Buddy\Objects\PermissionSet;
use Buddy\Objects\Project;
use Buddy\Objects\Scenario;
use Buddy\Objects\SourceContent;
use Buddy\Objects\User;
use Buddy\Objects\Webhook;
use Buddy\Objects\Workspace;

class Utils
{
    /**
     * @var Buddy
     */
    private static $buddy;

    /**
     * @var Workspace
     */
    private static $workspace;

    /**
     * @return string
     */
    public static function randomString()
    {
        return time() . substr(md5(rand()), 0, 9);
    }

    /**
     * @return string
     */
    public static function randomEmail()
    {
        return self::randomString() . '@mailinator.com';
    }

    /**
     * @return int
     */
    public static function randomInteger()
    {
        return rand(0, 100000);
    }

    /**
     * @return Buddy
     */
    public static function getBuddy()
    {
        if (!self::$buddy) {
            self::$buddy = new Buddy([
                'accessToken' => getenv('TOKEN_ALL')
            ]);
        }
        return self::$buddy;
    }

    /**
     * @return Workspace
     * @throws BuddySDKException
     */
    public static function getWorkspace()
    {
        if (!self::$workspace){
            $array = self::getBuddy()->getApiWorkspaces()->getWorkspaces()->getWorkspaces();
            if (count($array) == 0){
                throw new BuddySDKException('You dont have any workspaces');
            }
            self::$workspace = $array[0];
        }
        return self::$workspace;
    }

    /**
     * @return string
     * @throws BuddySDKException
     */
    public static function getWorkspaceDomain()
    {
        return self::getWorkspace()->getDomain();
    }

    /**
     * @return \Buddy\Objects\Project
     * @throws BuddySDKException
     */
    public static function addProject()
    {
        $workspace = self::getWorkspace();
        $project = new Project();
        $project->setName(Utils::randomString());
        return Utils::getBuddy()->getApiProjects()->addProject($project, $workspace->getDomain());
    }

    /**
     * @return User
     */
    public static function addUser()
    {
        $user = new User();
        $user->setEmail(self::randomEmail());
        return Utils::getBuddy()->getApiMembers()->addWorkspaceMember($user, self::getWorkspaceDomain());
    }

    /**
     * @param Project $project
     * @param User $user
     * @return User
     * @throws BuddySDKException
     */
    public static function addUser2Project(Project $project, User $user)
    {
        $user->setPermissionSet(self::addPermission());
        return Utils::getBuddy()->getApiProjects()->addProjectMember($user, Utils::getWorkspaceDomain(), $project->getName());
    }

    /**
     * @param Group $group
     * @param User $user
     * @return User
     */
    public static function addUser2Group(Group $group, User $user)
    {
        return Utils::getBuddy()->getApiGroups()->addGroupMember($user, self::getWorkspaceDomain(), $group->getId());
    }

    /**
     * @return PermissionSet
     */
    public static function addPermission()
    {
        $perm = new PermissionSet();
        $perm->setName(self::randomString());
        $perm->setDescription(self::randomString());
        $perm->setReleaseScenarioAccessLevel(PermissionSet::RELEASE_SCENARIO_ACCESS_LEVEL_READ_WRITE);
        $perm->setRepositoryAccessLevel(PermissionSet::REPOSITORY_ACCESS_LEVEL_READ_WRITE);
        return self::getBuddy()->getApiPermissions()->addWorkspacePermission($perm, self::getWorkspaceDomain());
    }

    /**
     * @return Group
     */
    public static function addGroup()
    {
        $group = new Group();
        $group->setName(Utils::randomString());
        $group->setDescription(Utils::randomString());
        return self::getBuddy()->getApiGroups()->addGroup($group, self::getWorkspaceDomain());
    }

    /**
     * @param Project $project
     * @return \Buddy\Objects\SourceCommitContent
     */
    public static function addFile(Project $project)
    {
        $base = base64_encode(self::randomString());
        $msg = self::randomString();
        $path = self::randomString();
        $content = new SourceContent();
        $content->setPath($path);
        $content->setMessage($msg);
        $content->setContent($base);
        $resp = self::getBuddy()->getApiSource()->addFile($content, Utils::getWorkspaceDomain(), $project->getName());
        sleep(3);
        return $resp;
    }

    /**
     * @param Project $project
     * @return \Buddy\Objects\Scenario
     */
    public static function addScenario(Project $project)
    {
        Utils::addFile($project);
        $scenario = new Scenario();
        $scenario->setName(Utils::randomString());
        $scenario->setAutomatic(true);
        $scenario->setBranch('master');
        return Utils::getBuddy()->getApiScenarios()->addScenario($scenario, Utils::getWorkspaceDomain(), $project->getName());
    }

    /**
     * @return Webhook
     */
    public static function addWebhook()
    {
        $webhook = new Webhook();
        $webhook->setTargetUrl('http://onet.pl');
        $webhook->setEvents([Webhook::EVENT_RELEASE_FAILED]);
        return Utils::getBuddy()->getApiWebhooks()->addWebhook($webhook, Utils::getWorkspaceDomain());
    }
}