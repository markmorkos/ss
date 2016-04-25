<?php
namespace SS\Model;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

/**
 * AppKernel.
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class AppKernel extends ExtendedKernel
{
    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        $bundles = [];
        $addBundles = function ($list) use (&$bundles) {
            $bundles = array_merge($bundles, $list);
        };

        // Framework
        $addBundles([
            new \Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new \Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new \Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new \Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \Symfony\Bundle\MonologBundle\MonologBundle(),
            new \Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new \Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new \Symfony\Bundle\TwigBundle\TwigBundle(),

            new \FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new \FOS\RestBundle\FOSRestBundle(),

            new \JMS\AopBundle\JMSAopBundle(),
            new \JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new \JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new \JMS\SerializerBundle\JMSSerializerBundle(),

            new \Bazinga\Bundle\JsTranslationBundle\BazingaJsTranslationBundle(),
            new \Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),

            #new \Liip\ImagineBundle\LiipImagineBundle(),

            new \Yucca\PrerenderBundle\YuccaPrerenderBundle(),
        ]);

        // Debug
        if ($this->isDebug()) {
            $addBundles([
                new \Symfony\Bundle\WebProfilerBundle\WebProfilerBundle(),
                new \Sensio\Bundle\DistributionBundle\SensioDistributionBundle(),
                new \Odesskij\Bundle\GeneratorBundle\OdesskijGeneratorBundle(),
            ]);
        }

        // Werkint
        $addBundles([
            new \Werkint\Bundle\FrameworkExtraBundle\WerkintFrameworkExtraBundle(),
            //new \Werkint\Bundle\RedisBundle\WerkintRedisBundle(),
            new \Werkint\Bundle\WebappBundle\WerkintWebappBundle(),
            new \Werkint\Bundle\FrontendMapperBundle\WerkintFrontendMapperBundle($this),
            new \Werkint\Bundle\TemplatingBundle\WerkintTemplatingBundle(),
            new \Werkint\Cms\CoreBundle\WerkintCmsCoreBundle(),
        ]);

        // Основные
        $addBundles([
            new \SS\Bundle\AppBundle\SSAppBundle(),
            new \Oneup\UploaderBundle\OneupUploaderBundle(),
        ]);

        return $bundles;
    }

    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $configDir = $this->getConfigDir();

        $env = explode('_', $this->getEnvironment())[0];
        $loader->load($configDir . '/config_' . $env . '.yml');
    }

    /**
     * @return string
     */
    protected function getConfigDir()
    {
        return SYMFONY_ROOT . '/config';
    }

    /**
     * {@inheritdoc}
     *
     * @api
     */
    public function getRootDir()
    {
        return SYMFONY_ROOT;
    }
}
