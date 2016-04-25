<?php
namespace SS\Bundle\AppBundle\Service\Util;

use SS\Bundle\AppBundle\Entity as SS;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @author Odesskij <odesskij1992@gmail.com>
 */
class ProgrammaticFileUploader
{
    /**
     * @var FileManager
     */
    private $fileManager;

    /**
     * @var string
     */
    private $webDir;

    /**
     * @var FileUrlManager
     */
    protected $urlManager;

    /**
     * @param FileManager    $fileManager
     * @param FileUrlManager $urlManager
     * @param string         $webDir
     */
    public function __construct(FileManager $fileManager, FileUrlManager $urlManager, $webDir)
    {
        $this->urlManager = $urlManager;
        $this->fileManager = $fileManager;
        $this->webDir = $webDir;
    }


    /**
     * @param string $source  full path to source file
     * @param string $gallery Gallery Id for OneupUploaderBundle
     * @throws \InvalidArgumentException
     * @return SS\Image
     */
    public function upload($source, $gallery, $skipFlush = false)
    {
        $oldFile = sys_get_temp_dir() . '/' . uniqid() . '.' . pathinfo($source, PATHINFO_EXTENSION);
        copy($source, $oldFile);
        $f = new File($oldFile);
        $file = $this->fileManager->createFile(
            $f,
            $gallery,
            $skipFlush
        );

        if (!$file instanceof SS\Image) {
            throw new \InvalidArgumentException('Invalid source file.');
        }
        $newFile = $this->webDir . '/' . $this->urlManager->getDir($file);
        $f->move($newFile);
        return $file;
    }
}