<?php

namespace Fansible\DevopsBundle;

use Fansible\DevopsBundle\DependencyInjection\Compiler\FinderCompilerPass;
use Fansible\DevopsBundle\DependencyInjection\Compiler\GeneratorCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class FansibleDevopsBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new FinderCompilerPass());
        $container->addCompilerPass(new GeneratorCompilerPass());
    }
}
