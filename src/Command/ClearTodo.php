<?php

namespace Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ClearTodo extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'clear-todo';

    protected function configure()
    {
        $this->setDescription("Clear All Title");
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
        $data['todos'] = [];

        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        $todo = file_put_contents($file, $jsonfile);
        // system('php bin/consoleapp.php list-todo');
        echo " Yeay !!!, Remove Your All Todo as Successfully";
        $command = $this->getApplication()->find('list-todo');
        $arguments = [
            ''
        ];
        $input = new ArrayInput($arguments);
        $returnCode = $command->run($input, $output);
        return $returnCode;
        // return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;
    }
}
