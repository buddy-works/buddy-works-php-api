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

namespace Buddy\Tests\Apis;

use Buddy\Buddy;
use PHPUnit\Framework\TestCase;

final class SshKeysTest extends TestCase
{
    public function testAddAndRemoveKey(): void
    {
        $buddy = new Buddy([
            'accessToken' => getenv('TOKEN_ALL'),
        ]);
        $keys = $buddy->getApiSshKeys();

        $response = $keys->addKey([
            'title' => 'Test Key',
            'content' => 'ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQCP9n9f/OwemjtxauxcV5OvZqY/MzHZ+pViWkVzf/IkMml6FiWlMIyb4slz4+xXNsMtfyYroAHeLeOLVUMbWCm42BCoscyOfGSYxVqj/yqnjdfJRG4THOdwKhc17LDH91J31uzYhcJO8WMp090wlyGCujW/GKpjs7Onf52vm0rcbS9UtrzUyeyOoqfD6HcbkWMYJU66lWH0JBdEpQB61BXpF8HlCwKWiS2QRXq+Cb+Jyvma1Ro2gpBctKWQCpaiTiKDwWHIiANW+RGqqyL2cS6jm26CBRH20WSObLB+94HJMttu19B91Ir3wdfERfa2hnwWTZ7fyErH3TotH/z2CLub',
        ]);
        $this->assertEquals(201, $response->getStatusCode());

        $response = $keys->deleteKey((int) $response->getBody()['id']);
        $this->assertEquals(204, $response->getStatusCode());
    }
}
