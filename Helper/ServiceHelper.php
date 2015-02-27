<?php

namespace Fansible\DevopsBundle\Helper;

use Fansible\DevopsBundle\Config\DatabaseConfig;

class ServiceHelper
{
    // database
    const MYSQL = 'mysql';
    const POSTGRESQL = 'postgresql';

    // web server
    const APACHE = 'apache';
    const NGINX = 'nginx';

    // others
    const NODE = 'node';
    const REDIS = 'redis';
    const RABBITMQ = 'rabbitmq';

    /**
     * @var array
     */
    private $allServices = [
        self::MYSQL, self::POSTGRESQL,
        self::APACHE, self::NGINX,
        self::NODE, self::REDIS, self::RABBITMQ,
    ];

    /**
     * @var array
     */
    private $services;

    public function __construct(DatabaseConfig $databaseConfig)
    {
        $this->services = [];
        $this->addService($databaseConfig->getService());
    }

    /**
     * @return array
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @param string $service
     *
     * @return $this
     */
    public function addService($service)
    {
        if (in_array($service, $this->allServices)) {
            $this->services[] = $service;
        }

        return $this;
    }
}
