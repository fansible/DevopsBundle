<?php

namespace Fansible\DevopsBundle\Generator\Ansible;

use Fansible\DevopsBundle\Config\ServicesConfig;
use Fansible\DevopsBundle\Generator\Helper\GeneratorInterface;

class RequirementsGenerator implements GeneratorInterface
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
     * @var \Fansible\DevopsBundle\Config\AnsibleRolesConfig
     */
    private $ansibleRolesConfig;

    /**
     * @param \Fansible\DevopsBundle\Generator\Helper\TwigHelper $twigHelper
     * @param ServicesConfig                                     $servicesConfig
     * @param \Fansible\DevopsBundle\Config\AnsibleRolesConfig   $ansibleRolesConfig
     */
    public function __construct($twigHelper, $servicesConfig, $ansibleRolesConfig)
    {
        $this->twigHelper = $twigHelper;
        $this->servicesConfig = $servicesConfig;
        $this->ansibleRolesConfig = $ansibleRolesConfig;
    }

    /**
     * @inheritdoc
     */
    public function generate()
    {
        if ($this->servicesConfig->isPresent(ServicesConfig::ANSIBLE)) {
            $this->twigHelper->render(
                'requirements.txt',
                'Ansible:requirements.txt.twig',
                [
                    'roles' => $this->ansibleRolesConfig->getRoles(),
                    'services' => $this->servicesConfig->getServices(),
                ]
            );
        }
    }
}
