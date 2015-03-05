<?php

namespace Fansible\DevopsBundle\Config;

use Fansible\DevopsBundle\Config\ServicesConfig;

class DatabaseConfig
{
    private $driverToService = array(
        'pdo_pgsql' => ServicesConfig::POSTGRESQL,
        'pdo_mysql' => ServicesConfig::MYSQL,
    );

    /**
     * @var string
     */
    private $service;

    /**
     * @var string
     **/
    private $name;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $password;

    /**
     * @param ServicesConfig $servicesConfig
     * @param array         $config
     */
    public function __construct($servicesConfig, array $config)
    {
        $driver = $config['driver'];
        if (isset($this->driverToService[$driver])) {
            $this->service = $this->driverToService[$driver];
            $servicesConfig->addService($this->service);
        }
        $this->name     = $config['name'];
        $this->user     = $config['user'];
        $this->password = $config['password'];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }
}
