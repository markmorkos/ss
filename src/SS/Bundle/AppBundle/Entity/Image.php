<?php
namespace SS\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use JMS\Serializer\Annotation as Serializer;

/**
 * FileImage Entity.
 *
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 *
 * @ORM\Entity(repositoryClass="SS\Bundle\AppBundle\Entity\ImageRepository")
 * @ORM\Table(name="app_image")
 * @Serializer\ExclusionPolicy("none")
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="string", length=10, nullable=false)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="\Werkint\Bundle\FrameworkExtraBundle\Service\Util\IdGenerator")
     * @Serializer\Type("string")
     * @Serializer\Expose()
     * @var string
     */
    protected $id;
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $mimeType;
    /**
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     * @var string
     */
    protected $name;
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $storage;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Type("integer")
     * @var string
     */
    protected $height;
    /**
     * @ORM\Column(type="integer")
     * @Serializer\Type("integer")
     * @var string
     */
    protected $width;


    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Serializer\Type("integer")
     * @var integer
     */
    protected $ordinal;


    /**
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Type("string")
     * @var string
     */
    protected $url;

    /**
     * @ManyToOne(targetEntity="Page")
     * @JoinColumn(name="page_id", referencedColumnName="id")
     */
    protected $page;



    // -- Accessors ---------------------------------------

    /**
     * @return string
     */
    public function getOrdinal()
    {
        return $this->ordinal;
    }

    /**
     * @param $ordinal
     * @return $this
     * @internal param string $order
     *
     */
    public function setOrdinal($ordinal)
    {
        $this->ordinal = $ordinal;
        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * @param string $mimeType
     * @return $this
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * @param string $storage
     * @return $this
     */
    public function setStorage($storage)
    {
        $this->storage = $storage;
        return $this;
    }

    /**
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param string $height
     * @return $this
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return string
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param string $width
     * @return $this
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }
}
