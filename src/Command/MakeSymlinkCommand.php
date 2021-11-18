<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MakeSymlinkCommand extends Command
{
    protected static $defaultName = 'app:make-symlink';
    protected static $defaultDescription = 'Add a short description for your command';

    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(string $name = null, ContainerInterface $container)
    {
        parent::__construct($name);

        $this->container = $container;
    }

    protected function configure(): void
    {
//        $this
//            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
//            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        exec(
            sprintf('ln -s %s %s',
                $this->container->getParameter('kernel.project_dir') . '/storage/upload',
                $this->container->getParameter('kernel.project_dir') . '/public'
            )
        );

        $io->success('Make symlink success.');

        return Command::SUCCESS;
    }
}
