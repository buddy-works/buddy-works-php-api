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

use Buddy\Objects\Email;
use Buddy\Tests\Utils;

class EmailsTest extends \PHPUnit_Framework_TestCase
{
    public function testGetEmails()
    {
        $resp = Utils::getBuddy()->getApiEmails()->getAuthenticatedUserEmails();
        $this->assertInstanceOf('Buddy\Objects\Emails', $resp);
        $this->assertInternalType('array', $resp->getEmails());
        $this->assertGreaterThan(0, $resp->getEmails());
        /**
         * @var \Buddy\Objects\Email $email
         */
        $email = $resp->getEmails()[0];
        $this->assertNotEmpty($email->getEmail());
        $this->assertInternalType('bool', $email->getConfirmed());
    }

    public function testAddAndDeleteEmail()
    {
        $email = new Email();
        $email->setEmail(Utils::randomEmail());
        $resp = Utils::getBuddy()->getApiEmails()->addAuthenticatedUserEmail($email);
        $this->assertInstanceOf('Buddy\Objects\Email', $resp);

        $resp = Utils::getBuddy()->getApiEmails()->deleteAuthenticatedUserEmail($email->getEmail());
        $this->assertEquals(true, $resp);
    }
}
