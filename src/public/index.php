<?php
use KanbanBoard\Authentication;
use KanbanBoard\GithubActual;
use KanbanBoard\Utilities;
use KanbanBoard\LoadConfiguration;

require '../classes/KanbanBoard/Github.php';
require '../classes/Utilities.php';
require '../classes/KanbanBoard/Authentication.php';
require '../classes/LoadConfiguration.php';
require '../classes/BusinessLayer/Board.php';
require '../classes/BusinessLayer/Issues.php';

LoadConfiguration::addToEnv();
$repositories = explode('|', Utilities::env('GH_REPOSITORIES'));
$authentication = new \KanbanBoard\Login();
$token = $authentication->login();
$github = new GithubClient($token, Utilities::env('GH_ACCOUNT'));
$board = new \KanbanBoard\Application($github, $repositories, array('waiting-for-feedback'));
$data = $board->board();
$m = new Mustache_Engine(array(
	'loader' => new Mustache_Loader_FilesystemLoader('../views'),
));
echo $m->render('index', array('milestones' => $data));
