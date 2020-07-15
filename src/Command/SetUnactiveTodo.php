<?php

namespace Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class SetUnactiveTodo extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'undone-todo';

    protected function configure()
    {
        $this->addArgument('id', InputArgument::REQUIRED);
        $this->setDescription("UnDone Your Title");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // ... put here the code to run in your command

        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        $id_todo = $input->getArgument('id');

        $file = "./json/todo.json";
        $todo = file_get_contents($file);
        $data = json_decode($todo, true);
        $find_id = array_filter($data['todos'], function ($v) use ($id_todo) {
            return ($v["id"] == $id_todo);
        });
        if ($find_id) {
            foreach ($find_id as $key => $value) {
                $data['todos'][$key]['complete'] = false;
            }
        }
        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        // system('php bin/consoleapp.php list-todo');
        echo ("\n");
        $todo = file_put_contents($file, $jsonfile);
        echo " keep trying !!!,  Your Todo as Undone\n";
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
