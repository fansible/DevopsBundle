<?php

namespace Fansible\DevopsBundle\Tests\Helper;

use Fansible\DevopsBundle\Config\DatabaseConfig;
use Fansible\DevopsBundle\Config\ServicesConfig;
use Phake;

class ServicesConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testAddNotSupportedService()
    {
        $databaseConfig = Phake::mock(DatabaseConfig::class);
        $servicesConfig = new ServicesConfig($databaseConfig);
        $servicesConfig->addService('notSupported');

        $this->assertEmpty($servicesConfig->getServices());
    }

    public function testAddDatabaseService()
    {
        $databaseConfig = Phake::mock(DatabaseConfig::class);
        Phake::when($databaseConfig)->getService()->thenReturn(ServicesConfig::MYSQL);
        $servicesConfig = new ServicesConfig($databaseConfig);
        $servicesConfig->addService('notSupported');

        $this->assertNotEmpty($servicesConfig->getServices());
    }
}
