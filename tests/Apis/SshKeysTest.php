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

use Buddy\Objects\SshKey;
use Buddy\Tests\Utils;

class SshKeysTest extends \PHPUnit_Framework_TestCase
{
    public function testGetKeysList()
    {
        $resp = Utils::getBuddy()->getApiSshKeys()->getAuthenticatedUserKeys();
        $this->assertInstanceOf('Buddy\Objects\SshKeys', $resp);
        $this->assertInternalType('array', $resp->getKeys());
    }

    public function testAddGetDeleteKey()
    {
        $key = new SshKey();
        $key->setContent('ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAAAgQCG0Ug3U8DoJ6+z36D2h2+oc4UoQRihLNGcAO9SHglFXp+dn1aGJrqeoOrmo4bj5AcydjY33Ylm7ixZEe85vD5INCeldMd8JGmZTj57mwzqpKXFrag+/v9F9qmSEPxKZ1cQj7Q/nRi/hJIoJbsxymrxWhdJZnDNeqwdusR78Xkftw== scot@scot-Macmini');
        $key->setTitle('Test');

        $resp = Utils::getBuddy()->getApiSshKeys()->addAuthenticatedUserKey($key);
        $this->assertInstanceOf('Buddy\Objects\SshKey', $resp);
        $this->assertEquals($key->getContent(), $resp->getContent());
        $this->assertEquals($key->getTitle(), $resp->getTitle());
        $this->assertGreaterThan(0, $resp->getId());

        $resp2 = Utils::getBuddy()->getApiSshKeys()->getAuthenticatedUserKey($resp->getId());
        $this->assertEquals($key->getContent(), $resp2->getContent());
        $this->assertEquals($key->getTitle(), $resp2->getTitle());
        $this->assertEquals($resp->getId(), $resp2->getId());

        $resp3 = Utils::getBuddy()->getApiSshKeys()->deleteAuthenticatedUserKey($resp2->getId());
        $this->assertEquals(true, $resp3);
    }
}
