<?php

namespace Fansible\DevopsBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Add simple calculator services tagged to simple statistics container
 */
class FinderCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritdoc
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('fansible_devops.container.finder')) {
            return;
        }

        $definition = $container->getDefinition('fansible_devops.container.finder');
        $taggedServices = $container->findTaggedServiceIds('fansible_devops.finder');

        foreach ($taggedServices as $id => $tagAttributes) {
            $definition->addMethodCall(
                'addFinder',
                [new Reference($id)]
            );
        }
    }
}
