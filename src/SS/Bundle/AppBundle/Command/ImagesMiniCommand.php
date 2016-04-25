<?php
namespace SS\Bundle\AppBundle\Command;

use Intervention\Image\ImageManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author Ekaterina Markova <migraciiushastojsovi@gmail.com>
 */
class ImagesMiniCommand extends ContainerAwareCommand implements ContainerAwareInterface
{
    /**
     * @var ImageManager
     */
    protected $manager;

    /** @var ContainerInterface */
    protected $container;

    protected function configure()
    {
        $this
            ->setName('image:mini')
            ->setDescription('Make mini copies of images')
            ->addArgument(
                'size',
                InputArgument::OPTIONAL,
                'How much to resize'
            );
    }

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


    /**
     * Executes the current command.
     *
     * This method is not abstract because you can use this class
     * as a concrete class. In this case, instead of defining the
     * execute() method, you set the code to execute by passing
     * a Closure to the setCode() method.
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @return null|int null or 0 if everything went fine, or an error code
     *
     * @throws \LogicException When this abstract method is not implemented
     *
     * @see setCode()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $size = $input->getArgument('size');
        if(!$size){
            $size = 2;
        }

        $this->manager = $this->container->get('ss_app.image_manager');
        $images = [];

        if ($dir = opendir($this->container->getParameter('kernel.root_dir') . '/../web/uploads/projects')) {
            $images = [];
            while (false !== ($file = readdir($dir))) {
                    if ($file != "." && $file != ".." && $file != "mini2" && $file != "mini4") {
                        $images[] = $file;
                    }
            }
            closedir($dir);
        }

        foreach ($images as $image) {
            $img = $this->manager->make($this->container->getParameter('kernel.root_dir') . '/../web/uploads/projects/' . $image);

            if($img->getWidth() > $img->getHeight()){
                $img->resize($img->getWidth() / $size, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }else{
                $img->resize(null, $img->getHeight() / $size, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
//
//            $fileNameArray = explode('/', $image);

            $path = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/projects/mini'.$size.'/' . $image;
            $img->save($path, 50);
        }

        if ($dir = opendir($this->container->getParameter('kernel.root_dir') . '/../web/uploads/journals')) {
            $images = [];
            while (false !== ($file = readdir($dir))) {
                if ($file != "." && $file != ".." && $file != "mini2" && $file != "mini4") {
                    $images[] = $file;
                }
            }
            closedir($dir);
        }

        foreach ($images as $image) {
            $img = $this->manager->make($this->container->getParameter('kernel.root_dir') . '/../web/uploads/journals/' . $image);

            if($img->getWidth() > $img->getHeight()){
                $img->resize($img->getWidth() / $size, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }else{
                $img->resize(null, $img->getHeight() / $size, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
//
//            $fileNameArray = explode('/', $image);

            $path = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/journals/mini'.$size.'/' . $image;
            $img->save($path, 50);
        }
    }
}