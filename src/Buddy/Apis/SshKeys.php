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

namespace Buddy\Apis;

use Buddy\BuddyResponse;

class SshKeys extends Api
{
    public function getKeys(?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/user/keys');
    }

    /**
     * @param mixed[] $data
     */
    public function addKey(array $data, ?string $accessToken = null): BuddyResponse
    {
        return $this->postJson($accessToken, $data, '/user/keys');
    }

    public function deleteKey(int $keyId, ?string $accessToken = null): BuddyResponse
    {
        return $this->deleteJson($accessToken, null, '/user/keys/:key_id', [
            'key_id' => $keyId,
        ]);
    }

    public function getKey(int $keyId, ?string $accessToken = null): BuddyResponse
    {
        return $this->getJson($accessToken, '/user/keys/:key_id', [
            'key_id' => $keyId,
        ]);
    }
}
