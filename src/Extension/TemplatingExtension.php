<?php

/*
 * Copyright (c) Tyler Sommer
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Nice\Extension;

use Nice\DependencyInjection\Compiler\RegisterTemplatingEnginesPass;
use Nice\DependencyInjection\Compiler\RegisterTemplatingLoadersPass;
use Nice\DependencyInjection\CompilerAwareExtensionInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

/**
 * Sets up Templating services
 */
class TemplatingExtension extends Extension implements CompilerAwareExtensionInterface
{
    /**
     * Loads a specific configuration.
     *
     * @param array            $config    An array of configuration values
     * @param ContainerBuilder $container A ContainerBuilder instance
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $container->register('templating', 'Symfony\Component\Templating\DelegatingEngine');

        $container->register('templating.loader', 'Symfony\Component\Templating\Loader\ChainLoader');
    }

    /**
     * Gets the CompilerPasses this extension requires.
     *
     * @return array|CompilerPassInterface[]
     */
    public function getCompilerPasses()
    {
        return array(
            new RegisterTemplatingEnginesPass(),
            new RegisterTemplatingLoadersPass()
        );
    }
}
