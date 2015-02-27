<?php

namespace Fansible\DevopsBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Add simple calculator services tagged to simple statistics container
 */
class GeneratorCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritdoc
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('fansible_devops.generator.container')) {
            return;
        }

        $definition = $container->getDefinition('fansible_devops.generator.container');
        $taggedServices = $container->findTaggedServiceIds('fansible_devops.generator');

        foreach ($taggedServices as $id => $tagAttributes) {
            $definition->addMethodCall(
                'addGenerator',
                [new Reference($id)]
            );
        }
    }
}
