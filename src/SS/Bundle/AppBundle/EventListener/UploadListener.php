<?php
namespace SS\Bundle\AppBundle\EventListener;

use Intervention\Image as Intervention;
use Doctrine\ORM\EntityManagerInterface;
use Intervention\Image\ImageManager;
use Oneup\UploaderBundle\Event\PostPersistEvent;
use SS\Bundle\AppBundle\Entity\Image;
use SS\Bundle\AppBundle\Service\Util\FileManager;
use SS\Bundle\AppBundle\Service\Util\FileUrlManager;

/**
 * @author Odesskij <odesskij1992@gmail.com>
 */
class UploadListener
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;
    /**
     * @var FileManager
     */
    protected $fileManager;
    /**
     * @var FileUrlManager
     */
    protected $fileUrlManager;
    /**
     * @var ImageManager
     */
    protected $manager;

    /**
     * @param EntityManagerInterface $em
     * @param ImageManager           $manager
     * @param FileUrlManager         $fileUrlManager
     * @param FileManager            $fileManager
     */
    public function __construct(
        EntityManagerInterface $em,
        Intervention\ImageManager $manager,
        FileUrlManager $fileUrlManager,
        FileManager $fileManager
    ) {
        $this->em = $em;
        $this->manager = $manager;
        $this->fileUrlManager = $fileUrlManager;
        $this->fileManager = $fileManager;
    }

    /**
     * @param PostPersistEvent $event
     */
    public function onUpload(PostPersistEvent $event)
    {

        $ret = $event->getResponse();

        /** @var \Symfony\Component\HttpFoundation\File\File $file */
        $file = $event->getFile();


        $img = $this->manager->make($file);

        if($img->getWidth() > $img->getHeight()){
            $img->resize($img->getWidth() / 2, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }else{
            $img->resize(null, $img->getHeight() / 2, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        $fileNameArray = explode('/', $file);
        if($fileNameArray[count($fileNameArray) - 2]!='slider'){
            $path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/'.$fileNameArray[count($fileNameArray) - 2].'/mini2/' . $fileNameArray[count($fileNameArray) -1 ];
            $img->save($path, 50);
        }




        $img = $this->manager->make($file);

        if($img->getWidth() > $img->getHeight()){
            $img->resize($img->getWidth() / 4, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }else{
            $img->resize(null, $img->getHeight() / 4, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        $fileNameArray = explode('/', $file);
        if($fileNameArray[count($fileNameArray) - 2]!='slider') {
            $path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $fileNameArray[count(
                    $fileNameArray
                ) - 2] . '/mini4/' . $fileNameArray[count($fileNameArray) - 1];
            $img->save($path, 50);
        }



        $extension = $file->getExtension();
        if (!$extension || !in_array($extension, ['jpeg', 'jpg', 'png', 'svg'])) {
            $ret['error'] = true;
            $ret['message'] = 'Wrong file extension';
            return;
        }

        $f = $this->fileManager->createFile($file, $event->getType());

        if (!$f instanceof Image) {
            $ret['error'] = true;
        } else {
            $ret['id'] = $f->getId();

            $uri = $this->fileUrlManager->getUrl($f);
            $ret['uri'] = $uri;

            $fileInfo = pathinfo($uri);

            if (is_array($fileInfo)) {
                if (!empty($fileInfo['extension'])) {
                    $ext = $fileInfo['extension'] == 'jpeg' ? 'jpg' : $fileInfo['extension'];
                    $ret['extension'] = $ext;
                }

                if (!empty($fileInfo['basename'])) {
                    $ret['basename'] = $fileInfo['basename'];
                }
            }
        }
    }

    //}
}