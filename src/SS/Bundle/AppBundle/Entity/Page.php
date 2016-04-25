<?php
namespace SS\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Page Entity.
 *
 * @ORM\Entity(repositoryClass="SS\Bundle\AppBundle\Entity\PageRepository")
 * @ORM\Table(name="app_page")
 * @Serializer\ExclusionPolicy("none")
 */
class Page
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
     * @Serializer\Expose()
     * @var string
     */
    protected $name;


    // -- Accessors ---------------------------------------

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
}
