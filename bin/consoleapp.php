<?php

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use App\Command\ListTodo;
use App\Command\AddTodo;
use App\Command\UpdateTodo;
use App\Command\RemoveTodo;
use App\Command\SetActiveTodo;
use App\Command\SetUnactiveTodo;
use App\Command\ClearTodo;

$application = new Application();

$application->add(new ListTodo());
$application->add(new AddTodo());
$application->add(new UpdateTodo());
$application->add(new RemoveTodo());
$application->add(new SetActiveTodo());
$application->add(new SetUnactiveTodo());
$application->add(new ClearTodo());

$application->run();
