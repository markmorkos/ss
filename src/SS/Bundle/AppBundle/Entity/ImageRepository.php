<?php
namespace SS\Bundle\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Ekaterina Markova <migraciiushastojsovi@gmail.com>
 */
class ImageRepository extends EntityRepository
{
    /**
     * @param $name
     * @return Image
     */
    public function findImage($name)
    {
        $qb = $this->createQueryBuilder('m');

        return $qb->select('p')
                  ->from('SSAppBundle:Image', 'p')
                  ->where('p.name = :name')
                  ->setParameter('name', $name)
                  ->getQuery()
                  ->getResult();
    }

    /**
     * @param $diskr
     * @return Image
     */
    public function getByPage($diskr)
    {
        $qb = $this->createQueryBuilder('m');

        return $qb->select('p')
                  ->from('SSAppBundle:Image', 'p')
                  ->leftJoin('p.page', 'page')
                  ->where('page.name = :page')
                  ->setParameter('page', $diskr)
                  ->getQuery()
                  ->getResult();
    }

}