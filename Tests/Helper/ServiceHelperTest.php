<?php

namespace Fansible\DevopsBundle\Tests\Helper;

use Fansible\DevopsBundle\Config\DatabaseConfig;
use Fansible\DevopsBundle\Helper\ServiceHelper;
use Phake;

class ServiceHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testAddNotSupportedService()
    {
        $databaseConfig = Phake::mock(DatabaseConfig::class);
        $serviceHelper = new ServiceHelper($databaseConfig);
        $serviceHelper->addService('notSupported');

        $this->assertEmpty($serviceHelper->getServices());
    }

    public function testAddDatabaseService()
    {
        $databaseConfig = Phake::mock(DatabaseConfig::class);
        Phake::when($databaseConfig)->getService()->thenReturn(ServiceHelper::MYSQL);
        $serviceHelper = new ServiceHelper($databaseConfig);
        $serviceHelper->addService('notSupported');

        $this->assertNotEmpty($serviceHelper->getServices());
    }
}
