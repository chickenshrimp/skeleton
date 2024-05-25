<?php

namespace App\Command;

use App\Repository\ShopsRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:show-shops',
    description: 'Shows a list of all shops',
)]
class ShowShopsCommand extends Command
{
    private ShopsRepository $shopsRepository;
    public function __construct(ShopsRepository $shopsRepository)
    {
        parent::__construct();
        $this->shopsRepository = $shopsRepository;
    }

    protected function configure(): void
    {
//        $this
//            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
//            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
//        ;
    }

    private function YieldShops()
    {
        $shops = $this->shopsRepository->findAll();
        if ($shops)
        {
            foreach ($shops as $shop)
            {
                yield "<database-style>".$shop->getShopName()."</database-style>" ;
            }
        }
        else{
            yield "<database-style>No shops in the database yet</database-style>";
        }

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
//        $arg1 = $input->getArgument('arg1');
//
//        if ($arg1) {
//            $io->note(sprintf('You passed an argument: %s', $arg1));
//        }

//        if ($input->getOption('option1')) {
//            // ...
//        }
        $style = new OutputFormatterStyle('cyan');
        $io->getFormatter()->setStyle("database-style", $style);
        $io->writeln($this->YieldShops());

//        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
