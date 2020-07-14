<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AddTodo extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'add';

    protected function configure()
    {
        $this->addArgument('title', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $title = $input->getArgument('title');

        $file = "todo.json";
        $todo = file_get_contents($file);
        $data = json_decode($todo, true);
        $data['todos'][] = array(
            'id' => count($data['todos']) + 1,
            'title' => $title,
            'complete' => false
        );

        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        $todo = file_put_contents($file, $jsonfile);
        echo "Argument Add Successfully";

        return Command::SUCCESS;
    }
}
