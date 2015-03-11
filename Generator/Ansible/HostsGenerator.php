<?php

namespace Fansible\DevopsBundle\Generator\Ansible;

use Fansible\DevopsBundle\Config\ServicesConfig;
use Fansible\DevopsBundle\Generator\Helper\GeneratorInterface;

class HostsGenerator implements GeneratorInterface
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
     * @var \Fansible\DevopsBundle\Config\EnvironmentsConfig
     */
    private $environmentsConfig;

    /**
     * @param \Fansible\DevopsBundle\Generator\Helper\TwigHelper $twigHelper
     * @param ServicesConfig                                     $servicesConfig
     * @param \Fansible\DevopsBundle\Config\EnvironmentsConfig   $environmentsConfig
     */
    public function __construct($twigHelper, $servicesConfig, $environmentsConfig)
    {
        $this->twigHelper = $twigHelper;
        $this->servicesConfig = $servicesConfig;
        $this->environmentsConfig = $environmentsConfig;
    }

    /**
     * @inheritdoc
     */
    public function generate()
    {
        if ($this->servicesConfig->isPresent(ServicesConfig::ANSIBLE)) {
            /** @var \Fansible\DevopsBundle\Config\EnvironmentConfig $environment */
            foreach ($this->environmentsConfig->getEnvironments() as $environment) {
                $this->twigHelper->renderProvisioningFile(
                    'inventory/' . $environment->getName(),
                    'Ansible:hosts.txt.twig',
                    [
                        'environment' => $environment,
                    ]
                );
            }
        }
    }
}
