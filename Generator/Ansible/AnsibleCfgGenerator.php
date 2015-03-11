<?php

namespace Fansible\DevopsBundle\Generator\Ansible;

use Fansible\DevopsBundle\Config\ServicesConfig;
use Fansible\DevopsBundle\Generator\Helper\GeneratorInterface;

class AnsibleCfgGenerator implements GeneratorInterface
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
     * @param \Fansible\DevopsBundle\Generator\Helper\TwigHelper $twigHelper
     * @param ServicesConfig                                     $servicesConfig
     */
    public function __construct($twigHelper, $servicesConfig)
    {
        $this->twigHelper = $twigHelper;
        $this->servicesConfig = $servicesConfig;
    }

    /**
     * @inheritdoc
     */
    public function generate()
    {
        if ($this->servicesConfig->isPresent(ServicesConfig::ANSIBLE)) {
            $this->twigHelper->render(
                'ansible.cfg',
                'Ansible:ansible.cfg.twig'
            );
        }
    }
}
