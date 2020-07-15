<?php

namespace Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateTodo extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'update-todo';

    protected function configure()
    {
        $this->addArgument('id', InputArgument::REQUIRED);
        $this->addArgument('title', InputArgument::REQUIRED);
        $this->setDescription("Update Title Selected");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // ... put here the code to run in your command

        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        $id = $input->getArgument('id');
        $title = $input->getArgument('title');

        $file = "./json/todo.json";
        $todo = file_get_contents($file);
        $data = json_decode($todo, true);
        $find_id = array_filter($data['todos'], function ($v) use ($id) {
            return ($v["id"] == $id);
        });
        if ($find_id) {
            foreach ($find_id as $key => $value) {
                $data['todos'][$key]['title'] = $title;
                $data['todos'][$key]['complete'] = false;
            }
        }
        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        $todo = file_put_contents($file, $jsonfile);
        // system('php bin/consoleapp.php list-todo');
        echo ("\n");
        echo " Yeay !!!, Update Your Todo as Successfully\n";
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
