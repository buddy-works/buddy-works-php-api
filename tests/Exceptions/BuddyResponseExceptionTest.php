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

namespace Buddy\Tests\Exceptions;

use Buddy\Exceptions\BuddyResponseException;
use PHPUnit\Framework\TestCase;

class BuddyResponseExceptionTest extends TestCase
{
    public function test(): void
    {
        $exp = new BuddyResponseException(500, [], 'test');
        $this->assertEquals('test', $exp->getBody());
        $this->assertEquals(500, $exp->getStatusCode());
        $this->assertIsArray($exp->getHeaders());
        $this->assertEquals('Something went wrong', $exp->getMessage());
    }

    public function testJsonError(): void
    {
        $exp = new BuddyResponseException(500, [], '{"error":"test"}');
        $this->assertEquals('test', $exp->getMessage());
    }

    public function testJsonError2(): void
    {
        $exp = new BuddyResponseException(500, [], '{"errors":[{"message":"test"}]}');
        $this->assertEquals('test', $exp->getMessage());
    }
}
