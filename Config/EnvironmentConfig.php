<?php

namespace Fansible\DevopsBundle\Config;

class EnvironmentConfig
{
    private $name;
    private $host;
    private $ip;

    /**
     * @param string $name
     * @param array  $config
     */
    public function __construct($name, array $config)
    {
        $this->name = $name;
        $this->host = $config['host'];
        $this->ip = $config['ip'];
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
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }
}
