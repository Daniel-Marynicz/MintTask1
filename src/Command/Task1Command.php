<?php

declare(strict_types=1);

namespace Task1\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Task1\FileGetContentsWrapper;
use Task1\UpdateTree;
use UnexpectedValueException;
use function is_string;

class Task1Command extends Command
{
    protected function configure() : void
    {
        $this
            ->setName('task1:update-tree-names')
            ->setDescription('Updates category names in tree.json')
            ->addOption(
                'language',
                'l',
                InputOption::VALUE_OPTIONAL,
                'Language',
                'pl_PL'
            )
            ->addArgument('treePath', InputArgument::REQUIRED, 'path to tree.json')
            ->addArgument('listPath', InputArgument::REQUIRED, 'path to list.json');
    }

    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $treePath = $input->getArgument('treePath');
        $listPath = $input->getArgument('listPath');
        $language = $input->getOption('language');

        if (! is_string($treePath)) {
            throw new UnexpectedValueException('expected string in treePath');
        }

        if (! is_string($listPath)) {
            throw new UnexpectedValueException('expected string in listPath');
        }

        if (! is_string($language)) {
            throw new UnexpectedValueException('expected string in language');
        }

        $updater = new UpdateTree(new JsonEncoder(), new FileGetContentsWrapper());
        $result  = $updater->getUpdatedTree($treePath, $listPath, $language);
        $output->write($result);

        return 0;
    }
}
