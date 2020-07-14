<?php

//composer dumpautoload -o
require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Console\Command\ListTodo;
use Console\Command\AddTodo;
use Console\Command\UpdateTodo;
use Console\Command\RemoveTodo;
use Console\Command\SetActiveTodo;
use Console\Command\SetUnactiveTodo;
use Console\Command\ClearTodo;

$application = new Application();

$application->add(new ListTodo());
$application->add(new AddTodo());
$application->add(new UpdateTodo());
$application->add(new RemoveTodo());
$application->add(new SetActiveTodo());
$application->add(new SetUnactiveTodo());
$application->add(new ClearTodo());

$application->run();
