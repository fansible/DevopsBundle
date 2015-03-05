<?php

namespace Fansible\DevopsBundle\Config;

class WebServerConfig
{
    private $services = array(
        ServicesConfig::APACHE,
        ServicesConfig::NGINX,
    );

    /**
     * @var string
     */
    private $service;

    /**
     * @var string
     */
    private $port;

    /**
     * @param ServicesConfig $servicesConfig
     * @param array         $config
     */
    public function __construct($servicesConfig, array $config)
    {
        $service = $config['service'];
        if (in_array($service, $this->services)) {
            $servicesConfig->addService($service);
            $this->service = $service;
        }
        $this->port = $config['port'];
    }

    /**
     * @return string
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }
}
