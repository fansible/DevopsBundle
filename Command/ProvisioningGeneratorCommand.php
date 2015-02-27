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
        $output->writeln('Generate start');
        $this->getContainer()->get('fansible_devops.generator.container')->generate();
        $output->writeln('Generate end');
    }
}
