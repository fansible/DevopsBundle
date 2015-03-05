<?php

namespace Fansible\DevopsBundle\Tests\Config;

use Fansible\DevopsBundle\Config\DatabaseConfig;
use Fansible\DevopsBundle\Config\ServicesConfig;

class DatabaseConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testGetters()
    {
        $databaseConfig = new DatabaseConfig('', 'name', 'user', 'password');

        $this->assertEquals('name', $databaseConfig->getName());
        $this->assertEquals('user', $databaseConfig->getUser());
        $this->assertEquals('password', $databaseConfig->getPassword());
    }

    public function testDriverNotSupported()
    {
        $databaseConfig = new DatabaseConfig('notSupported');

        $this->assertNull($databaseConfig->getService());
    }

    public function testMysqlDriver()
    {
        $databaseConfig = new DatabaseConfig('pdo_mysql');

        $this->assertEquals(ServicesConfig::MYSQL, $databaseConfig->getService());
    }

    public function testPostgresqlDriver()
    {
        $databaseConfig = new DatabaseConfig('pdo_pgsql');

        $this->assertEquals(ServicesConfig::POSTGRESQL, $databaseConfig->getService());
    }
}
