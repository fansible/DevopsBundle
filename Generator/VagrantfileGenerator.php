<?php

namespace Fansible\DevopsBundle\Generator;

use Fansible\DevopsBundle\Generator\Helper\GeneratorInterface;

class VagrantfileGenerator implements GeneratorInterface
{
    /**
     * @var \Fansible\DevopsBundle\Config\VagrantConfig
     */
    private $vagrantConfig;

    /**
     * @var \Fansible\DevopsBundle\Generator\Helper\TwigHelper
     */
    private $twigHelper;

    /**
     * @param \Fansible\DevopsBundle\Config\VagrantConfig        $vagrantConfig
     * @param \Fansible\DevopsBundle\Generator\Helper\TwigHelper $twigHelper
     */
    public function __construct($vagrantConfig, $twigHelper)
    {
        $this->vagrantConfig = $vagrantConfig;
        $this->twigHelper = $twigHelper;
    }

    public function generate()
    {
        $this->twigHelper->render(
            'Vagrantfile',
            'Vagrant/Vagrantfile.twig',
            [
                'config' => $this->vagrantConfig,
            ]
        );
    }
}
