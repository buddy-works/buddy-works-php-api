<?php


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
            'content' => 'ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQCP9n9f/OwemjtxauxcV5OvZqY/MzHZ+pViWkVzf/IkMml6FiWlMIyb4slz4+xXNsMtfyYroAHeLeOLVUMbWCm42BCoscyOfGSYxVqj/yqnjdfJRG4THOdwKhc17LDH91J31uzYhcJO8WMp090wlyGCujW/GKpjs7Onf52vm0rcbS9UtrzUyeyOoqfD6HcbkWMYJU66lWH0JBdEpQB61BXpF8HlCwKWiS2QRXq+Cb+Jyvma1Ro2gpBctKWQCpaiTiKDwWHIiANW+RGqqyL2cS6jm26CBRH20WSObLB+94HJMttu19B91Ir3wdfERfa2hnwWTZ7fyErH3TotH/z2CLub'
        ]);
        $this->assertEquals(201, $response->getStatusCode());

        $response = $keys->deleteKey((int) $response->getBody()['id']);
        $this->assertEquals(204, $response->getStatusCode());
    }
}
