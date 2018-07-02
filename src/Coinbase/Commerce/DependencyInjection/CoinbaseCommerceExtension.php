<?php
/**
 * Created by PhpStorm.
 * User: msen
 * Date: 6/28/18
 * Time: 4:22 PM
 */

namespace App\Coinbase\Commerce\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class CoinbaseCommerceExtension extends Extension
{

    /**
     * Loads a specific configuration.
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );

        try {
            $loader->load('services.xml');
        } catch (\Exception $e) {
        }

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // we now have these 3 config keys
        // $config['api']['key'], $config['api']['version'] and $config['webhook']['secret']

        $definition = $container->getDefinition('coinbase.commerce.client');
        $definition->replaceArgument(0, $config['api']['key']);
        $definition->replaceArgument(1, $config['api']['version']);
        $definition->replaceArgument(2, $config['webhook']['secret']);

    }
}