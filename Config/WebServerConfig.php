<?php

namespace Fansible\DevopsBundle\Config;

use Fansible\DevopsBundle\Helper\ServiceHelper;

class WebServerConfig
{
    private $types = array(
        ServiceHelper::APACHE,
        ServiceHelper::NGINX,
    );

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     **/
    private $hostname;

    /**
     * @param ServiceHelper $serviceHelper
     * @param string        $type
     * @param string        $hostname
     */
    public function __construct($serviceHelper, $type = '', $hostname = '')
    {
        if (in_array($type, $this->types)) {
            $serviceHelper->addService($type);
            $this->type = $type;
        }
        $this->hostname = $hostname;
    }

    /**
     * @return string
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
