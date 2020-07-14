<?php

namespace Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AddTodo extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'add-todo';

    protected function configure()
    {
        $this->addArgument('title', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // ... put here the code to run in your command

        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        $title = $input->getArgument('title');

        $file = "./json/todo.json";
        $todo = file_get_contents($file);
        $data = json_decode($todo, true);
        $data['todos'][] = array(
            'id' => count($data['todos']) + 1,
            'title' => $title,
            'complete' => false
        );

        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        $todo = file_put_contents($file, $jsonfile);
        echo " Yeay !!!, Add Your Todo as Successfully";
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;
    }
}
