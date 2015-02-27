<?php

namespace Fansible\DevopsBundle\Generator\Ansible;

use Fansible\DevopsBundle\Generator\Helper\GeneratorInterface;

class HostsGenerator implements GeneratorInterface
{
    /**
     * @var \Fansible\DevopsBundle\Config\AnsibleConfig
     */
    private $config;

    /**
     * @var \Fansible\DevopsBundle\Generator\Helper\TwigHelper
     */
    private $twigHelper;

    /**
     * @param \Fansible\DevopsBundle\Config\AnsibleConfig          $config
     * @param \Fansible\DevopsBundle\Generator\Helper\TwigHelper   $twigHelper
     */
    public function __construct($config, $twigHelper)
    {
        $this->config = $config;
        $this->twigHelper = $twigHelper;
    }

    /**
     * @inheritdoc
     */
    public function generate()
    {
        $this->twigHelper->render(
            $this->config->getProvisioningPath() . '/inventory/vagrant',
            'Ansible/hosts.twig'
        );
    }
}
