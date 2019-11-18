<?php

declare(strict_types=1);
/**
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at.
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

use Buddy\Apis\Permissions;
use Buddy\Apis\Pipelines;
use Buddy\Apis\Webhooks;
use Buddy\Buddy;
use Buddy\Exceptions\BuddySDKException;

class Utils
{
    /**
     * @var Buddy
     */
    private static $buddy;

    /**
     * @var array
     */
    private static $workspace;

    /**
     * @return string
     */
    public static function randomString()
    {
        return time().substr(md5(rand()), 0, 9);
    }

    /**
     * @return string
     */
    public static function randomEmail()
    {
        return self::randomString().'@mailinator.com';
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
                'accessToken' => getenv('TOKEN_ALL'),
            ]);
        }

        return self::$buddy;
    }

    /**
     * @throws BuddySDKException
     *
     * @return array
     */
    public static function getWorkspace()
    {
        if (!self::$workspace) {
            $array = self::getBuddy()->getApiWorkspaces()->getWorkspaces()->getBody();
            if (empty($array['workspaces']) || count($array['workspaces']) == 0) {
                throw new BuddySDKException('You dont have any workspaces');
            }
            self::$workspace = $array['workspaces'][0];
        }

        return self::$workspace;
    }

    /**
     * @throws BuddySDKException
     *
     * @return string
     */
    public static function getWorkspaceDomain()
    {
        $workspace = self::getWorkspace();

        return $workspace['domain'];
    }

    /**
     * @throws BuddySDKException
     *
     * @return array
     */
    public static function addProject()
    {
        return Utils::getBuddy()->getApiProjects()->addProject([
            'name' => Utils::randomString(),
        ], self::getWorkspaceDomain())->getBody();
    }

    /**
     * @return array
     */
    public static function addUser()
    {
        return Utils::getBuddy()->getApiMembers()->addWorkspaceMember(self::getWorkspaceDomain(), self::randomEmail())->getBody();
    }

    /**
     * @param string $projectName
     * @param int    $userId
     * @param int    $permissionId
     *
     * @throws BuddySDKException
     *
     * @return array
     */
    public static function addUser2Project($projectName, $userId, $permissionId)
    {
        return Utils::getBuddy()->getApiProjects()->addProjectMember(self::getWorkspaceDomain(), $projectName, $userId, $permissionId)->getBody();
    }

    /**
     * @param int $groupId
     * @param int $userId
     *
     * @return array
     */
    public static function addUser2Group($groupId, $userId)
    {
        return Utils::getBuddy()->getApiGroups()->addGroupMember(self::getWorkspaceDomain(), $groupId, $userId)->getBody();
    }

    /**
     * @return array
     */
    public static function addPermission()
    {
        return self::getBuddy()->getApiPermissions()->addWorkspacePermission([
            'name' => self::randomString(),
            'description' => self::randomString(),
            'pipeline_access_level' => Permissions::PIPELINE_ACCESS_LEVEL_READ_WRITE,
            'repository_access_level' => Permissions::REPOSITORY_ACCESS_LEVEL_READ_WRITE,
        ], self::getWorkspaceDomain())->getBody();
    }

    /**
     * @return array
     */
    public static function addGroup()
    {
        return self::getBuddy()->getApiGroups()->addGroup([
            'name' => self::randomString(),
            'description' => self::randomString(),
        ], self::getWorkspaceDomain())->getBody();
    }

    /**
     * @param string $projectName
     *
     * @return array
     */
    public static function addFile($projectName)
    {
        $resp = self::getBuddy()->getApiSource()->addFile([
            'content' => base64_encode(self::randomString()),
            'message' => self::randomString(),
            'path' => self::randomString(),
        ], self::getWorkspaceDomain(), $projectName)->getBody();
        sleep(3);

        return $resp;
    }

    /**
     * @param string $projectName
     *
     * @return array
     */
    public static function addScenario($projectName)
    {
        Utils::addFile($projectName);

        return Utils::getBuddy()->getApiPipelines()->addPipeline([
            'name' => self::randomString(),
            'ref_name' => 'master',
            'trigger_mode' => Pipelines::PIPELINE_TRIGGER_MODE_ON_EVERY_PUSH,
        ], self::getWorkspaceDomain(), $projectName)->getBody();
    }

    /**
     * @return array
     */
    public static function addWebhook()
    {
        return Utils::getBuddy()->getApiWebhooks()->addWebhook([
            'events' => [Webhooks::EVENT_EXECUTION_FAILED],
            'target_url' => 'http://wp.pl',
        ], self::getWorkspaceDomain())->getBody();
    }
}
