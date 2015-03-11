<?php

namespace Fansible\DevopsBundle\Config;

class ServicesConfig
{
    // base
    const APT= 'apt';
    const PHP = 'php';
    const COMPOSER = 'composer';

    // provisioning
    const ANSIBLE = 'ansible';
    const DOCKER = 'docker';

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
        self::APT, self::PHP, self::COMPOSER,
        self::ANSIBLE, self::DOCKER,
        self::MYSQL, self::POSTGRESQL,
        self::APACHE, self::NGINX,
        self::NODE, self::REDIS, self::RABBITMQ,
    ];

    /**
     * @var array
     */
    private $services;

    /**
     * @param string                                               $provisioning
     * @param \Fansible\DevopsBundle\Finder\Helper\FinderContainer $finderContainer
     */
    public function __construct($provisioning, $finderContainer)
    {
        $this->services = [
            self::APT,
            self::PHP,
            self::COMPOSER,
        ];
        $this->addService($provisioning);
        if (null !== $services = $finderContainer->getServices()) {
            foreach ($services as $service) {
                $this->addService($service);
            }
        }
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

    /**
     * @param string $service
     *
     * @return bool
     */
    public function isPresent($service)
    {
        return in_array($service, $this->services);
    }
}
