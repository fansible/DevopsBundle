<?php

namespace Fansible\DevopsBundle\Generator;

use Fansible\DevopsBundle\Finder\MysqlFinder;

class AnsibleGenerator extends TwigHelper
{
    /** @var string */
    private $provisioningPath = 'devops/provisioning/';

    /** @var array */
    private $roles = [
        MysqlFinder::NAME => ['name' => 'ANXS.mysql', 'version' => 'v1.0.3'],
    ];

    /**
     * @param array $services
     */
    public function generate(array $services = [])
    {
        $this->generatePlaybook($services);
        $this->generateRequirements($services);
        $this->generateConfig();
        $this->generateHosts();
    }

    public function generateConfig()
    {
        $this->render(
            $this->provisioningPath . 'ansible.cfg',
            $this->getTwigPath('Ansible/ansible.cfg.twig')
        );
    }

    public function generateHosts()
    {
        $this->render(
            $this->provisioningPath . '/inventory/vagrant',
            $this->getTwigPath('Ansible/hosts.twig')
        );
    }

    /**
     * @param array $services
     */
    public function generatePlaybook(array $services = [])
    {
        $this->render(
            $this->provisioningPath . 'playbook.yml',
            $this->getTwigPath('Ansible/playbook.yml.twig'),
            [
                'project_name' => 'devops',
                'hosts' => 'all',
                'sudo' => 'yes',
                'roles' => $this->roles,
                'packages' => $services,
            ]
        );
    }

    /**
     * @param array $services
     */
    public function generateRequirements(array $services = [])
    {
        $this->render(
            $this->provisioningPath . 'requirements.txt',
            $this->getTwigPath('Ansible/requirements.txt.twig'),
            [
                'roles' => $this->roles,
                'services' => $services,
            ]
        );
    }
}
