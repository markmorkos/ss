<?php
namespace SS\Bundle\AppBundle\Service\Util;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use SS\Bundle\AppBundle\Entity\Image;

/**
 * @author Odesskij <odesskij1992@gmail.com>
 */
class FileUrlManager implements
    EventSubscriberInterface
{
    /**
     * @var string
     */
    protected $kernelRoot;

    /**
     * @param string $kernelRoot
     */
    public function __construct($kernelRoot)
    {
        $this->kernelRoot = $kernelRoot;
    }

    /**
     * @param Image $file
     * @return string
     */
    public function getUrl(Image $file)
    {
        return $this->getDir($file) . '/' . $file->getName();
    }

    /**
     * @param Image $file
     * @return string
     */
    public function getDir(Image $file)
    {
        return '/uploads/' . $file->getStorage();
    }

    /**
     * Full path to file
     *
     * @param Image $file
     * @return string
     */
    public function getPath(Image $file)
    {
        return realpath($this->kernelRoot . '/web' .
            $this->getDir($file) . '/' . $file->getName());
    }

    /**
     * Returns the events to which this class has subscribed.
     *
     * Return format:
     *     array(
     *         array('event' => 'the-event-name', 'method' => 'onEventName', 'class' => 'some-class', 'format' => 'json'),
     *         array(...),
     *     )
     *
     * The class may be omitted if the class wants to subscribe to events of all classes.
     * Same goes for the format key.
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [[
            'event'  => 'serializer.post_serialize',
            'class'  => 'SS\Bundle\AppBundle\Entity\Image',
            'method' => 'onPostSerialize',
        ]];
    }
}