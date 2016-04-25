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
class PageRepository extends EntityRepository
{

    /**
     * @return array
     */
    public function getPages()
    {
        $qb = $this->createQueryBuilder('m');

        return $qb->select('p')
                  ->from('SSAppBundle:Page', 'p')
                  ->getQuery()
                  ->getResult();
    }
}