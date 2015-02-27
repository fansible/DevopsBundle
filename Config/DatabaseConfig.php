<?php

namespace Fansible\DevopsBundle\Config;

class DatabaseConfig
{
    const POSTGRESQL = 'postgresql';
    const MYSQL      = 'mysql';

    private $types = array(
        'pdo_pgsql' => DatabaseConfig::POSTGRESQL,
        'pdo_mysql' => DatabaseConfig::MYSQL,
    );

    /**
     * @var string
     */
    private $type;

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
     * @param string $driver
     * @param string $name
     * @param string $user
     * @param string $password
     */
    public function __construct($driver = '', $name = '', $user = '', $password = '')
    {
        $this->setType($driver);
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $driver
     */
    public function setType($driver)
    {
        $this->type = $this->types[$driver];
    }
}