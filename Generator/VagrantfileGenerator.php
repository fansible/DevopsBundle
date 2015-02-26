<?php

namespace Fansible\DevopsBundle\Generator;

use Fansible\DevopsBundle\Generator\Helper\GeneratorInterface;

class VagrantfileGenerator implements GeneratorInterface
{
    /**
     * @var \Fansible\DevopsBundle\Finder\Helper\FinderContainer
     */
    private $finderContainer;

    /**
     * @var \Fansible\DevopsBundle\Generator\Helper\TwigHelper
     */
    private $twigHelper;

    /**
     * @param \Fansible\DevopsBundle\Finder\Helper\FinderContainer $finderContainer
     * @param \Fansible\DevopsBundle\Generator\Helper\TwigHelper   $twigHelper
     */
    public function __construct($finderContainer, $twigHelper)
    {
        $this->finderContainer = $finderContainer;
        $this->twigHelper = $twigHelper;
    }

    public function generate()
    {
        $this->twigHelper->render(
            'Vagrantfile',
            'Vagrant/Vagrantfile.twig',
            [
                'project_name' => 'sharepear',
                'vagrant_box' => 'ubuntu/trusty64',
                'vagrant_ip' => '199.199.199.199',
                'vagrant_memory' => '2048',
                'vagrant_cpus' => '2',
                'vagrant_exec' => '100',
                'vagrant_src' => '.',
                'vagrant_dest' => '/var/www/sharepear/current',
                'hostfile' => 'devops/privisioning/inventory/vagrant',
            ]
        );
    }
}
