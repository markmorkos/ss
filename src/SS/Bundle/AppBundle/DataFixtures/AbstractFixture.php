<?php
namespace SS\Bundle\AppBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture as BaseAbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * TODO: write "AbstractFixture" info
 */
abstract class AbstractFixture extends BaseAbstractFixture implements
    FixtureInterface,
    OrderedFixtureInterface,
    ContainerAwareInterface
{
    private static $output = null;

    /**
     * @param int $verbosity
     * @return null|ConsoleOutput
     */
    public static function getOutput($verbosity = ConsoleOutput::VERBOSITY_VERY_VERBOSE)
    {
        if (!self::$output) {
            self::$output = new ConsoleOutput($verbosity);
        }
        return self::$output;
    }

    /**
     * @param int $max
     * @return null|ProgressBar
     */
    public static function getProgressBar($max = 0)
    {
        $output = self::getOutput();
        if ($output) {
            return new ProgressBar($output, $max);
        }
        return null;
    }

    /** @var ContainerInterface */
    protected $container;

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        if ($this->isEnabled()) {
            $this->initialize($this->container);
            $this->loadFixture($manager);
        }
    }

    /**
     * @param ContainerInterface $container
     */
    public function initialize(ContainerInterface $container)
    {

    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return true;
    }
}