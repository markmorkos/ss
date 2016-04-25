<?php
namespace SS\Bundle\AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Werkint\Cms\CoreBundle\Entity\Item;
use Werkint\Cms\CoreBundle\Entity\ItemBlock;
use Werkint\Cms\CoreBundle\Entity\ItemFolder;

class DumpItemsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('cms:symfony:dump')
            ->setDescription('Dump items from database to file');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $itemsPath = $this->getContainer()->getParameter('ss_app.config_directory') . '/items.json';
        $itemFoldersPath = $this->getContainer()->getParameter('ss_app.config_directory') . '/itemFolders.json';

        $items = $this->getContainer()->get('werkint_cms_core.repo.item')->findAll();

        $folders = [];
        $blocks = [];
        foreach($items as $item) {
            if ($item instanceof ItemFolder) {
                $folders[] = [
                    'l' => null,
                    'v' => $item,
                ];
            }
            if ($item instanceof ItemBlock) {
                $blocks[] = $item;
            }
        }
        file_put_contents($itemsPath, $this->serializeItems($blocks));
        $output->writeln("blocks dumped at:\n" . $itemsPath);

        $calculateLevel = function(&$folderData) use(&$folders, &$calculateLevel) {
            if ($folderData['l']) {
                return $folderData['l'];
            }
            /** @var ItemFolder $folder */
            $folder = $folderData['v'];
            if ($lookedId = $folder->getParent()) {
                $lookedId = $lookedId->getId();
                foreach($folders as $folderData2) {
                    /** @var ItemFolder $folder2 */
                    $folder2 = $folderData2['v'];
                    if ($folder2->getId() == $lookedId) {
                        return $folderData['l'] = $calculateLevel($folderData2) + 1;
                    }
                }
                throw new \Exception('Something goes wrong while calculating folder level');
            }
            return $folderData['l'] = 0;
        };
        foreach($folders as &$folderData) {
            $folderData['l'] = $calculateLevel($folderData);
        }
        unset($folderData);
        usort($folders, function(array $folderData, array $folderData2) {
            if ($folderData['l'] > $folderData2['l']) {
                return 1;
            } elseif ($folderData['l'] < $folderData2['l']) {
                return -1;
            }
            return 0;
        });
        $foldersSorted = [];
        foreach($folders as $folderData) {
            $foldersSorted[] = $folderData['v'];
        }

        file_put_contents($itemFoldersPath, $this->serializeItems($foldersSorted));
        $output->writeln("folder blocks dumped at:\n" . $itemFoldersPath);
    }

    /**
     * @param Item[] $items
     * @return string
     */
    protected function serializeItems($items)
    {
        $arr = [];
        foreach($items as $item) {
            $tmp = [
                'id' => $item->getId(),
                'parent_id' => $item->getParent() ? $item->getParent()->getId() : null,
                'title' => $item->getTitle(),
                'class' => $item->getClass(),
            ];
            if ($item instanceof ItemBlock) {
                $tmp['dataJson'] = $item->getDataJson();
                $tmp['dataStructure'] = $item->getDataStructure();
                $tmp['text'] = $item->getText();
            }
            $arr[] = $tmp;
        }
        return json_encode($arr);
    }
}