<?php

namespace Fansible\DevopsBundle\Generator;

use Fansible\DevopsBundle\Finder\MysqlFinder;
use Fansible\DevopsBundle\Finder\PostgresqlFinder;
use Fansible\DevopsBundle\Generator\Helper\GeneratorInterface;

class AnsibleGenerator implements GeneratorInterface
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

    /**
     * @var string
     */
    private $provisioningPath = 'devops/provisioning/';

    /**
     * @var array
     */
    private $roles = [
        MysqlFinder::NAME => ['name' => 'ANXS.mysql', 'version' => 'v1.0.3'],
        PostgresqlFinder::NAME => ['name' => 'ANXS.postgresql', 'version' => 'v1.0.4'],
    ];

    /**
     * @inheritdoc
     */
    public function generate()
    {
        $this->generatePlaybook();
        $this->generateRequirements();
        $this->generateAnsibleConfig();
        $this->generateRolesConfig();
        $this->generateHosts();
    }

    public function generateRolesConfig()
    {
    }

    public function generateAnsibleConfig()
    {
        $this->twigHelper->render(
            $this->provisioningPath . 'ansible.cfg',
            'Ansible/ansible.cfg.twig'
        );
    }

    public function generateHosts()
    {
        $this->twigHelper->render(
            $this->provisioningPath . '/inventory/vagrant',
            'Ansible/hosts.twig'
        );
    }

    public function generatePlaybook()
    {
        $this->twigHelper->render(
            $this->provisioningPath . 'playbook.yml',
            'Ansible/playbook.yml.twig',
            [
                'project_name' => 'devops',
                'hosts' => 'all',
                'sudo' => 'yes',
                'roles' => $this->roles,
                'packages' => $this->finderContainer->getServices(),
            ]
        );
    }

    public function generateRequirements()
    {
        $this->twigHelper->render(
            $this->provisioningPath . 'requirements.txt',
            'Ansible/requirements.txt.twig',
            [
                'roles' => $this->roles,
                'services' => $this->finderContainer->getServices(),
            ]
        );
    }
}
