<?php

namespace Moskalyovd\FDLBundle\DependencyInjection;


use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;

class MoskalyovdFDLExtension extends ConfigurableExtension
{
    protected function loadInternal(array $mergedConfig, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $container->setParameter('moskalyovd_fdl.api_key', $mergedConfig['api_key']);
        $container->setParameter('moskalyovd_fdl.domain', $mergedConfig['domain']);
    }
}
