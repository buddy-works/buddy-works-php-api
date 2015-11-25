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

namespace Tests\Exceptions;

use Buddy\BuddyClient;
use Buddy\Exceptions\BuddyResponseException;

class BuddyResponseExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $exp = new BuddyResponseException(500, [], 'test');
        $this->assertEquals('test', $exp->getBody());
        $this->assertEquals(500, $exp->getStatusCode());
        $this->assertInternalType('array', $exp->getHeaders());
        $this->assertEquals('Something went wrong', $exp->getMessage());
    }

    public function testJsonError()
    {
        $exp = new BuddyResponseException(500, [], '{"error":"test"}');
        $this->assertEquals('test', $exp->getMessage());
    }

    public function testJsonError2()
    {
        $exp = new BuddyResponseException(500, [], '{"errors":[{"message":"test"}]}');
        $this->assertEquals('test', $exp->getMessage());
    }
}