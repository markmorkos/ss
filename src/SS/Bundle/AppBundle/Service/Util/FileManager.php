<?php
namespace SS\Bundle\AppBundle\Service\Util;

use Doctrine\ORM\EntityManagerInterface;
use Intervention\Image\ImageManager;
use SS\Bundle\AppBundle\Entity as SS;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @author Odesskij <odesskij1992@gmail.com>
 */
class FileManager
{


    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var ImageManager
     */
    protected $manager;

    /**
     * @var array
     */
    protected $allowedMem = [
        'image/jpeg',
        'image/png',
        'image/svg+xml'
    ];

    /**
     * @param EntityManagerInterface $em
     * @param ImageManager           $manager
     */
    public function __construct(
        EntityManagerInterface $em,
        ImageManager $manager
    ) {
        $this->em = $em;
        $this->manager = $manager;
    }

    /**
     * @param File   $file
     * @param string $gallery Gallery Id for OneupUploaderBundle
     * @param bool   $skipFlush
     * @return File|NULL
     */
    public function createFile(File $file, $gallery, $skipFlush = false)
    {
        if (!in_array($file->getMimeType(), $this->allowedMem)) {
            return null;
        }
        $f = new SS\Image();
        $image = $this->manager->make($file->getRealPath());

        $f->setWidth($image->width());
        $f->setHeight($image->height());


        $f->setMimeType($file->getMimeType())
            ->setStorage($gallery)
            ->setName($file->getBasename());

        $this->em->persist($f);


        if (!$skipFlush) {
            $this->em->flush();
        }

        return $f;
    }


}