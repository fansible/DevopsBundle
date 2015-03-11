<?php

namespace Fansible\DevopsBundle\Generator\Ansible;

use Fansible\DevopsBundle\Config\ServicesConfig;
use Fansible\DevopsBundle\Generator\Helper\GeneratorInterface;

class PlaybookGenerator implements GeneratorInterface
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
     * @var string
     */
    private $projectName;

    /**
     * @var string
     */
    private $timezone;

    /**
     * @param \Fansible\DevopsBundle\Generator\Helper\TwigHelper $twigHelper
     * @param ServicesConfig                                     $servicesConfig
     * @param \Fansible\DevopsBundle\Config\AnsibleRolesConfig   $ansibleRolesConfig
     * @param string                                             $projectName
     * @param string                                             $timezone
     */
    public function __construct($twigHelper, $servicesConfig, $ansibleRolesConfig, $projectName, $timezone)
    {
        $this->twigHelper = $twigHelper;
        $this->servicesConfig = $servicesConfig;
        $this->ansibleRolesConfig = $ansibleRolesConfig;
        $this->projectName = $projectName;
        $this->timezone = $timezone;
    }

    /**
     * @inheritdoc
     */
    public function generate()
    {
        if ($this->servicesConfig->isPresent(ServicesConfig::ANSIBLE)) {
            $this->twigHelper->renderProvisioningFile(
                'playbook.yml',
                'Ansible/playbook.yml.twig',
                [
                    'project_name' => $this->projectName,
                    'hosts' => 'all',
                    'sudo' => 'yes',
                    'roles' => $this->ansibleRolesConfig->getRoles(),
                    'services' => $this->servicesConfig->getServices(),
                    'timezone' => $this->timezone,
                ]
            );
        }
    }
}
