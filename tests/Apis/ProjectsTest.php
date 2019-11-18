<?php

declare(strict_types=1);

namespace Buddy\Tests\Apis;

use Buddy\Buddy;
use PHPUnit\Framework\TestCase;

final class ProjectsTest extends TestCase
{
    public function testProjectList(): void
    {
        $buddy = new Buddy([
            'accessToken' => getenv('TOKEN_ALL'),
        ]);
        $workspace = $buddy->getApiWorkspaces()->getWorkspaces()->getBody()['workspaces'][0]['domain'];
        $projects = $buddy->getApiProjects()->getProjects($workspace);

        $this->assertIsArray($projects->getBody());
        $this->assertIsArray($projects->getHeaders());
        $this->assertIsInt($projects->getStatusCode());
    }
}
