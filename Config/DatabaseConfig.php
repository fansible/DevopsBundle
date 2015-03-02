<?php

namespace Fansible\DevopsBundle\Config;

use Fansible\DevopsBundle\Helper\ServiceHelper;

class DatabaseConfig
{
    private $driverToService = array(
        'pdo_pgsql' => ServiceHelper::POSTGRESQL,
        'pdo_mysql' => ServiceHelper::MYSQL,
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
     * @param ServiceHelper $serviceHelper
     * @param string        $driver
     * @param string        $name
     * @param string        $user
     * @param string        $password
     */
    public function __construct($serviceHelper, $driver = '', $name = '', $user = '', $password = '')
    {
        if (isset($this->driverToService[$driver])) {
            $this->service = $this->driverToService[$driver];
            $serviceHelper->addService($this->service);
        }
        $this->name     = $name;
        $this->user     = $user;
        $this->password = $password;
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
