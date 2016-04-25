<?php
namespace SS\Bundle\AppBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 */
class SSAppExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configDir = realpath(__DIR__ . '/../Resources/config');
        $container->setParameter(
            $this->getAlias() . '.scripts_dir',
            realpath(__DIR__ . '/../Resources/scripts')
        );
        $container->setParameter(
            $this->getAlias() . '.data',
            realpath(__DIR__ . '/../Resources/config/data')
        );

        // У нас есть корневые скрипты
        $container->setParameter(
            $this->getAlias() . '.frontend_config', [
                [
                    'path' => realpath(__DIR__ . '/../Resources/frontend'),
                    'name' => '',
                ],
            ]
        );

        $container->setParameter(
            $this->getAlias() . '.config_directory',
            $configDir
        );
        $loader = new YamlFileLoader(
            $container,
            new FileLocator($configDir)
        );
        $loader->load('services.yml');
        $loader->load('doctrine.yml');
    }
}
