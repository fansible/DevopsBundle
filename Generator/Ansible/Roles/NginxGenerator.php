<?php

namespace Fansible\DevopsBundle\Generator\Ansible\Roles;

use Fansible\DevopsBundle\Config\ServicesConfig;
use Fansible\DevopsBundle\Generator\Helper\GeneratorInterface;

class NginxGenerator implements GeneratorInterface
{
    /**
     * @var \Fansible\DevopsBundle\Generator\Helper\TwigHelper
     */
    private $twigHelper;

    /**
     * @var ServicesConfig
     */
    private $servicesConfig;

    /**
     * @var \Fansible\DevopsBundle\Config\WebServerConfig
     */
    private $webServerConfig;

    /**
     * @param \Fansible\DevopsBundle\Generator\Helper\TwigHelper $twigHelper
     * @param ServicesConfig                                     $servicesConfig
     * @param \Fansible\DevopsBundle\Config\WebServerConfig      $webServerConfig
     */
    public function __construct($twigHelper, $servicesConfig, $webServerConfig)
    {
        $this->twigHelper = $twigHelper;
        $this->servicesConfig = $servicesConfig;
        $this->webServerConfig = $webServerConfig;
    }

    /**
     * @inheritdoc
     */
    public function generate()
    {
        if ($this->servicesConfig->isPresent(ServicesConfig::ANSIBLE)
            && $this->servicesConfig->isPresent(ServicesConfig::NGINX)
        ) {
            $this->twigHelper->renderProvisioningFile(
                'vars/nginx.yml',
                'Ansible/Roles:nginx.yml.twig',
                [
                    'port' => $this->webServerConfig->getPort(),
                ]
            );
        }
    }
}
