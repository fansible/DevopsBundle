<?php

namespace Fansible\DevopsBundle\Command;

use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ProvisioningGeneratorCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('devops:provisioning:generate')
            ->setDescription('Generate Symfony provisioning')
        ;
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $services = $this->getContainer()->get('fansible_devops.container.finder')->getServices();

        $output->writeln('Generate playbook');
        $this->getContainer()->get('fansible_devops.generate.ansible')->generate($services);

        $output->writeln('Generate Vagranfile');
        $this->getContainer()->get('fansible_devops.generate.vagrantfile')->generate($services);
    }
}
