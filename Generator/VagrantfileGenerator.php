<?php

namespace Fansible\DevopsBundle\Generator;

class VagrantfileGenerator extends TwigHelper
{
    public function generate()
    {
        $this->render(
            'Vagrantfile',
            $this->getTwigPath('Vagrant/Vagrantfile.twig'),
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
