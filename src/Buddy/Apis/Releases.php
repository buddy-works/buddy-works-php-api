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

use Buddy\Objects\Release;

class Releases extends Api
{
    /**
     * @param string $domain
     * @param string $projectName
     * @param int $scenarioId
     * @param array $filters
     * @param null|string $accessToken
     * @return \Buddy\Objects\Releases
     */
    public function getScenarioReleases($domain, $projectName, $scenarioId, array $filters = [], $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/release_scenarios/:release_scenario_id/releases', [
            'domain' => $domain,
            'project_name' => $projectName,
            'release_scenario_id' => $scenarioId
        ], $filters)->getAsReleases();
    }

    /**
     * @codeCoverageIgnore
     * @param Release $release
     * @param string $domain
     * @param string $projectName
     * @param int $scenarioId
     * @param null|string $accessToken
     * @return Release
     */
    public function runRelease(Release $release, $domain, $projectName, $scenarioId, $accessToken = null)
    {
        return $this->postJson($accessToken, [
            'revision' => $release->getRevision(),
            'comment' => $release->getComment()
        ], '/workspaces/:domain/projects/:project_name/release_scenarios/:release_scenario_id/releases', [
            'domain' => $domain,
            'project_name' => $projectName,
            'release_scenario_id' => $scenarioId
        ])->getAsRelease();
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param int $scenarioId
     * @param int $releaseId
     * @param null|string $accessToken
     * @return Release
     */
    public function getScenarioRelease($domain, $projectName, $scenarioId, $releaseId, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/release_scenarios/:release_scenario_id/releases/:release_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'release_scenario_id' => $scenarioId,
            'release_id' => $releaseId
        ])->getAsRelease();
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param int $scenarioId
     * @param int $releaseId
     * @param null|string $accessToken
     * @return Release
     */
    public function cancelRelease($domain, $projectName, $scenarioId, $releaseId, $accessToken = null)
    {
        return $this->patchJson($accessToken, [
            'operation' => 'CANCEL'
        ], '/workspaces/:domain/projects/:project_name/release_scenarios/:release_scenario_id/releases/:release_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'release_scenario_id' => $scenarioId,
            'release_id' => $releaseId
        ])->getAsRelease();
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param int $scenarioId
     * @param int $releaseId
     * @param null|string $accessToken
     * @return Release
     */
    public function retryRelease($domain, $projectName, $scenarioId, $releaseId, $accessToken = null)
    {
        return $this->patchJson($accessToken, [
            'operation' => 'RETRY'
        ], '/workspaces/:domain/projects/:project_name/release_scenarios/:release_scenario_id/releases/:release_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'release_scenario_id' => $scenarioId,
            'release_id' => $releaseId
        ])->getAsRelease();
    }
}
