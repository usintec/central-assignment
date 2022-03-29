<?php
namespace KanbanBoard;

class BoardLayer {
    public function __construct($github, $repositories, $paused_labels = array())
	{
		$this->github = $github;
		$this->repositories = $repositories;
		$this->paused_labels = $paused_labels;
        $this->issuesLayer = new \KanbanBoard\IssuesLayer($this->github, $this->repositories, $this->paused_labels);

	}

    public function board(){
        $ms = array();
		foreach ($this->repositories as $repository)
		{
			foreach ($this->github->milestones($repository) as $data)
			{
				$ms[$data['title']] = $data;
				$ms[$data['title']]['repository'] = $repository;
			}
		}
		ksort($ms);
		foreach ($ms as $name => $data)
		{
			$issues = $this->issuesLayer->issues($data['repository'], $data['number']);
			$percent = $this->issuesLayer->percent($data['closed_issues'], $data['open_issues']);
			if($percent)
			{
				$milestones[] = array(
					'milestone' => $name,
					'url' => $data['html_url'],
					'progress' => $percent,
					'queued' => $issues['queued'],
					'active' => $issues['active'],
					'completed' => $issues['completed']
				);
			}
		}
		return $milestones;		$ms = array();
		foreach ($this->repositories as $repository)
		{
			foreach ($this->github->milestones($repository) as $data)
			{
				$ms[$data['title']] = $data;
				$ms[$data['title']]['repository'] = $repository;
			}
		}
		ksort($ms);
		foreach ($ms as $name => $data)
		{
			$issues = $this->issuesLayer->issues($data['repository'], $data['number']);
			$percent = $this->issuesLayer->percent($data['closed_issues'], $data['open_issues']);
			if($percent)
			{
				$milestones[] = array(
					'milestone' => $name,
					'url' => $data['html_url'],
					'progress' => $percent,
					'queued' => $issues['queued'],
					'active' => $issues['active'],
					'completed' => $issues['completed']
				);
			}
		}
		return $milestones;
    }
}