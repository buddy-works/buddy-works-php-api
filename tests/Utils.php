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
    private static Buddy $buddy;

    /**
     * @var mixed[]
     */
    private static array $workspace;

    public static function randomString(): string
    {
        return time().substr(md5((string) random_int(0, mt_getrandmax())), 0, 9);
    }

    public static function randomEmail(): string
    {
        return self::randomString().'@mailinator.com';
    }

    public static function randomInteger(): int
    {
        return random_int(0, 100000);
    }

    public static function getBuddy(): Buddy
    {
        if (!self::$buddy instanceof Buddy) {
            self::$buddy = new Buddy([
                'accessToken' => getenv('TOKEN_ALL'),
            ]);
        }

        return self::$buddy;
    }

    /**
     * @return mixed[]
     */
    public static function getWorkspace(): array
    {
        if (!self::$workspace) {
            $array = self::getBuddy()->getApiWorkspaces()->getWorkspaces()->getBody();
            if (empty($array['workspaces']) || (is_countable($array['workspaces']) ? count($array['workspaces']) : 0) == 0) {
                throw new BuddySDKException('You dont have any workspaces');
            }
            self::$workspace = $array['workspaces'][0];
        }

        return self::$workspace;
    }

    /**
     * @throws BuddySDKException
     */
    public static function getWorkspaceDomain(): string
    {
        $workspace = self::getWorkspace();

        return $workspace['domain'];
    }

    /**
     * @return mixed[]
     */
    public static function addProject(): array
    {
        return Utils::getBuddy()->getApiProjects()->addProject([
            'name' => Utils::randomString(),
        ], self::getWorkspaceDomain())->getBody();
    }

    /**
     * @return mixed[]
     */
    public static function addUser(): array
    {
        return Utils::getBuddy()->getApiMembers()->addWorkspaceMember(self::getWorkspaceDomain(), self::randomEmail())->getBody();
    }

    /**
     * @return mixed[]
     */
    public static function addUser2Project(string $projectName, int $userId, int $permissionId): array
    {
        return Utils::getBuddy()->getApiProjects()->addProjectMember(self::getWorkspaceDomain(), $projectName, $userId, $permissionId)->getBody();
    }

    /**
     * @return mixed[]
     */
    public static function addUser2Group(int $groupId, int $userId): array
    {
        return Utils::getBuddy()->getApiGroups()->addGroupMember(self::getWorkspaceDomain(), $groupId, $userId)->getBody();
    }

    /**
     * @return mixed[]
     */
    public static function addPermission(): array
    {
        return self::getBuddy()->getApiPermissions()->addWorkspacePermission([
            'name' => self::randomString(),
            'description' => self::randomString(),
            'pipeline_access_level' => Permissions::PIPELINE_ACCESS_LEVEL_READ_WRITE,
            'repository_access_level' => Permissions::REPOSITORY_ACCESS_LEVEL_READ_WRITE,
        ], self::getWorkspaceDomain())->getBody();
    }

    /**
     * @return mixed[]
     */
    public static function addGroup(): array
    {
        return self::getBuddy()->getApiGroups()->addGroup([
            'name' => self::randomString(),
            'description' => self::randomString(),
        ], self::getWorkspaceDomain())->getBody();
    }

    /**
     * @return mixed[]
     */
    public static function addFile(string $projectName): array
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
     * @return mixed[]
     */
    public static function addScenario(string $projectName): array
    {
        Utils::addFile($projectName);

        return Utils::getBuddy()->getApiPipelines()->addPipeline([
            'name' => self::randomString(),
            'ref_name' => 'master',
            'trigger_mode' => Pipelines::PIPELINE_TRIGGER_MODE_ON_EVERY_PUSH,
        ], self::getWorkspaceDomain(), $projectName)->getBody();
    }

    /**
     * @return mixed[]
     */
    public static function addWebhook(): array
    {
        return Utils::getBuddy()->getApiWebhooks()->addWebhook([
            'events' => [Webhooks::EVENT_EXECUTION_FAILED],
            'target_url' => 'http://wp.pl',
        ], self::getWorkspaceDomain())->getBody();
    }
}
