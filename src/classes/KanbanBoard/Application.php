<?php
namespace KanbanBoard;
use Github\Client;
use vierbergenlars\SemVer\version;

use vierbergenlars\SemVer\expression;
use vierbergenlars\SemVer\SemVerException;
use \Michelf\Markdown;

class Application {

	public function __construct($github, $repositories, $paused_labels = array())
	{
		$this->boardLayer = new \KanbanBoard\BoardLayer($github, $repositories, $paused_labels);
	}

	public function board()
	{
		return $this->boardLayer->board();
	}
}
