<?php

namespace Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListTodo extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'list-todo';

    protected function configure()
    {
        // ...
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // ... put here the code to run in your command

        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        $file = "./json/todo.json";
        $todo = file_get_contents($file);
        $data = json_decode($todo, true);
        $data = array_map(function ($x) {
            return ($x['id'] . ". " . $x['title'] . " " . $x['complete']);
        }, $data['todos']);

        $output->writeln($data);
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;
    }
}
