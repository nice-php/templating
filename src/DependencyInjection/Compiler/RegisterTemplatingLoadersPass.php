<?php

/*
 * Copyright (c) Tyler Sommer
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Nice\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class RegisterTemplatingLoadersPass implements CompilerPassInterface
{
    /**
     * Registers services tagged with "templating.engine" with Templating
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('templating.loader')) {
            return;
        }

        $definition = $container->getDefinition('templating.loader');
        foreach ($container->findTaggedServiceIds('templating.loader') as $service => $tag) {
            $definition->addMethodCall('addLoader', array(new Reference($service)));
        }
    }
}
