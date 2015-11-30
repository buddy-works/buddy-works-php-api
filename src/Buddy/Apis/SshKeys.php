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

use Buddy\Objects\SshKey;

class SshKeys extends Api
{
    /**
     * @param null|string $accessToken
     * @return \Buddy\Objects\SshKeys
     */
    public function getAuthenticatedUserKeys($accessToken = null)
    {
        return $this->getJson($accessToken, '/user/keys')->getAsSshKeys();
    }

    /**
     * @param SshKey $key
     * @param null|string $accessToken
     * @return SshKey
     */
    public function addAuthenticatedUserKey(SshKey $key, $accessToken = null)
    {
        return $this->postJson($accessToken, [
            'title' => $key->getTitle(),
            'content' => $key->getContent()
        ], '/user/keys')->getAsSshKey();
    }

    /**
     * @param int $keyId
     * @param null|string $accessToken
     * @return bool
     */
    public function deleteAuthenticatedUserKey($keyId, $accessToken = null)
    {
        return $this->deleteJson($accessToken, null, '/user/keys/:key_id', [
            'key_id' => $keyId
        ])->getAsBool();
    }

    /**
     * @param int $keyId
     * @param null|string $accessToken
     * @return SshKey
     */
    public function getAuthenticatedUserKey($keyId, $accessToken = null)
    {
        return $this->getJson($accessToken, '/user/keys/:key_id', [
            'key_id' => $keyId
        ])->getAsSshKey();
    }
}
