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

use Buddy\Objects\Scenario;
use Buddy\Objects\ScenarioAction;

class Scenarios extends Api
{
    /**
     * @param string $domain
     * @param string $projectName
     * @param array $filters
     * @param null|string $accessToken
     * @return \Buddy\Objects\Scenarios
     */
    public function getScenarios($domain, $projectName, array $filters = [], $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/release_scenarios', [
            'domain' => $domain,
            'project_name' => $projectName
        ], $filters)->getAsScenarios();
    }

    /**
     * @param Scenario $scenario
     * @param string $domain
     * @param string $projectName
     * @param null|string $accessToken
     * @return Scenario
     */
    public function addScenario(Scenario $scenario, $domain, $projectName, $accessToken = null)
    {
        return $this->postJson($accessToken, [
            'name' => $scenario->getName(),
            'branch' => $scenario->getBranch(),
            'automatic' => $scenario->getAutomatic()
        ], '/workspaces/:domain/projects/:project_name/release_scenarios', [
            'domain' => $domain,
            'project_name' => $projectName
        ])->getAsScenario();
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param int $scenarioId
     * @param null|string $accessToken
     * @return Scenario
     */
    public function getScenario($domain, $projectName, $scenarioId, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/release_scenarios/:release_scenario_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'release_scenario_id' => $scenarioId
        ])->getAsScenario();
    }

    /**
     * @param Scenario $scenario
     * @param string $domain
     * @param string $projectName
     * @param int $scenarioId
     * @param null|string $accessToken
     * @return Scenario
     */
    public function editScenario(Scenario $scenario, $domain, $projectName, $scenarioId, $accessToken = null)
    {
        return $this->patchJson($accessToken, [
            'name' => $scenario->getName(),
            'branch' => $scenario->getBranch(),
            'automatic' => $scenario->getAutomatic()
        ], '/workspaces/:domain/projects/:project_name/release_scenarios/:release_scenario_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'release_scenario_id' => $scenarioId
        ])->getAsScenario();
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param int $scenarioId
     * @param null|string $accessToken
     * @return bool
     */
    public function deleteScenario($domain, $projectName, $scenarioId, $accessToken = null)
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/projects/:project_name/release_scenarios/:release_scenario_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'release_scenario_id' => $scenarioId
        ])->getAsBool();
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param int $scenarioId
     * @param null|string $accessToken
     * @return \Buddy\Objects\ScenarioActions
     */
    public function getScenarioActions($domain, $projectName, $scenarioId, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/release_scenarios/:release_scenario_id/actions', [
            'domain' => $domain,
            'project_name' => $projectName,
            'release_scenario_id' => $scenarioId
        ])->getAsScenarioActions();
    }

    /**
     * @param ScenarioAction $action
     * @param string $domain
     * @param string $projectName
     * @param int $scenarioId
     * @param null|string $accessToken
     * @return ScenarioAction
     */
    public function addScenarioAction(ScenarioAction $action, $domain, $projectName, $scenarioId, $accessToken = null)
    {
        return $this->postJson($accessToken, [
            'type' => $action->getType(),
            'local_path' => $action->getLocalPath(),
            'remote_path' => $action->getRemotePath(),
            'working_directory' => $action->getWorkingDirectory(),
            'commands' => $action->getCommands(),
            'bucket_name' => $action->getBucketName(),
            'access_key' => $action->getAccessKey(),
            'secret_key' => $action->getSecretKey(),
            'public_access' => $action->getPublicAccess(),
            'cloudfront_id' => $action->getCloudfrontId(),
            'reduced_redundancy' => $action->getReducedRedundancy(),
            'login' => $action->getLogin(),
            'password' => $action->getPassword(),
            'active_mode' => $action->getActiveMode(),
            'host' => $action->getHost(),
            'authentication_mode' => $action->getAuthenticationMode(),
            'server_key' => $action->getServerKey(),
            'passphrase' => $action->getPassphrase()
        ], '/workspaces/:domain/projects/:project_name/release_scenarios/:release_scenario_id/actions', [
            'domain' => $domain,
            'project_name' => $projectName,
            'release_scenario_id' => $scenarioId
        ])->getAsScenarioAction();
    }

    /**
     * @param array $actionsIds
     * @param string $domain
     * @param string $projectName
     * @param int $scenarioId
     * @param null|string $accessToken
     * @return bool
     */
    public function reorderScenarioActions(array $actionsIds, $domain, $projectName, $scenarioId, $accessToken = null)
    {
        $tmp = [];
        foreach($actionsIds as $id){
            $tmp[] = [
                'id' => $id
            ];
        }
        return $this->putJson($accessToken, $tmp, '/workspaces/:domain/projects/:project_name/release_scenarios/:release_scenario_id/actions', [
            'domain' => $domain,
            'project_name' => $projectName,
            'release_scenario_id' => $scenarioId
        ])->getAsBool();
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param int $scenarioId
     * @param int $actionId
     * @param null|string $accessToken
     * @return ScenarioAction
     */
    public function getScenarioAction($domain, $projectName, $scenarioId, $actionId, $accessToken = null)
    {
        return $this->getJson($accessToken, '/workspaces/:domain/projects/:project_name/release_scenarios/:release_scenario_id/actions/:action_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'release_scenario_id' => $scenarioId,
            'action_id' => $actionId
        ])->getAsScenarioAction();
    }

    /**
     * @param ScenarioAction $action
     * @param string $domain
     * @param string $projectName
     * @param int $scenarioId
     * @param int $actionId
     * @param null|string $accessToken
     * @return ScenarioAction
     */
    public function editScenarioAction(ScenarioAction $action, $domain, $projectName, $scenarioId, $actionId, $accessToken = null)
    {
        return $this->patchJson($accessToken, [
            'local_path' => $action->getLocalPath(),
            'remote_path' => $action->getRemotePath(),
            'working_directory' => $action->getWorkingDirectory(),
            'commands' => $action->getCommands(),
            'bucket_name' => $action->getBucketName(),
            'access_key' => $action->getAccessKey(),
            'secret_key' => $action->getSecretKey(),
            'public_access' => $action->getPublicAccess(),
            'cloudfront_id' => $action->getCloudfrontId(),
            'reduced_redundancy' => $action->getReducedRedundancy(),
            'login' => $action->getLogin(),
            'password' => $action->getPassword(),
            'active_mode' => $action->getActiveMode(),
            'host' => $action->getHost(),
            'authentication_mode' => $action->getAuthenticationMode(),
            'server_key' => $action->getServerKey(),
            'passphrase' => $action->getPassphrase()
        ], '/workspaces/:domain/projects/:project_name/release_scenarios/:release_scenario_id/actions/:action_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'release_scenario_id' => $scenarioId,
            'action_id' => $actionId
        ])->getAsScenarioAction();
    }

    /**
     * @param string $domain
     * @param string $projectName
     * @param int $scenarioId
     * @param int $actionId
     * @param null|string $accessToken
     * @return bool
     */
    public function deleteScenarioAction($domain, $projectName, $scenarioId, $actionId, $accessToken = null)
    {
        return $this->deleteJson($accessToken, null, '/workspaces/:domain/projects/:project_name/release_scenarios/:release_scenario_id/actions/:action_id', [
            'domain' => $domain,
            'project_name' => $projectName,
            'release_scenario_id' => $scenarioId,
            'action_id' => $actionId
        ])->getAsBool();
    }
}
