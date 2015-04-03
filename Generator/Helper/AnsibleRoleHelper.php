<?php

namespace Fansible\DevopsBundle\Generator\Helper;

use Fansible\DevopsBundle\Config\ServicesConfig;

abstract class AnsibleRoleHelper implements GeneratorInterface
{
    /**
     * @var \Fansible\DevopsBundle\Generator\Helper\TwigHelper
     */
    protected $twigHelper;

    /**
     * @var ServicesConfig
     */
    protected $servicesConfig;

    /**
     * @param \Fansible\DevopsBundle\Generator\Helper\TwigHelper $twigHelper
     * @param ServicesConfig                                     $servicesConfig
     */
    public function __construct($twigHelper, $servicesConfig)
    {
        $this->twigHelper = $twigHelper;
        $this->servicesConfig = $servicesConfig;
    }

    /**
     * @return string
     */
    abstract public function getService();

    /**
     * @return array
     */
    public function getParameters()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function generate()
    {
        if ($this->servicesConfig->isPresent(ServicesConfig::ANSIBLE)
            && $this->servicesConfig->isPresent($this->getService())
        ) {
            $this->twigHelper->renderProvisioningFile(
                'vars/' . $this->getService() . '.yml',
                'Ansible/Roles:' . $this->getService() . '.yml.twig',
                $this->getParameters()
            );
        }
    }
}
