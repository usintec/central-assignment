<?php
namespace KanbanBoard;

use \Michelf\Markdown;

class IssuesLayer {
    public function __construct($github, $repositories, $paused_labels = array())
	{
		$this->github = $github;
		$this->repositories = $repositories;
		$this->paused_labels = $paused_labels;
	}
    
    public function issues($repository, $milestone_id)
	{
		$i = $this->github->issues($repository, $milestone_id);
		foreach ($i as $ii)
		{
			if (isset($ii['pull_request']))
				continue;
			$issues[$ii['state'] === 'closed' ? 'completed' : (($ii['assignee']) ? 'active' : 'queued')][] = array(
				'id' => $ii['id'], 'number' => $ii['number'],
				'title'            	=> $ii['title'],
				'body'             	=> Markdown::defaultTransform($ii['body']),
     'url' => $ii['html_url'],
				'assignee'         	=> (is_array($ii) && array_key_exists('assignee', $ii) && !empty($ii['assignee'])) ? $ii['assignee']['avatar_url'].'?s=16' : NULL,
				'paused'			=> self::labels_match($ii, $this->paused_labels),
				'progress'			=> self::percent(
											substr_count(strtolower($ii['body']), '[x]'),
											substr_count(strtolower($ii['body']), '[ ]')),
				'closed'			=> $ii['closed_at']
			);
		}
		usort($issues['active'], function ($a, $b) {
			return count($a['paused']) - count($b['paused']) === 0 ? strcmp($a['title'], $b['title']) : count($a['paused']) - count($b['paused']);
		});
		return $issues;
	}

    private static function labels_match($issue, $needles)
	{
		if(Utilities::hasValue($issue, 'labels')) {
			foreach ($issue['labels'] as $label) {
				if (in_array($label['name'], $needles)) {
					return array($label['name']);
				}
			}
		}
		return array();

	}

	public static function percent($complete, $remaining)
	{
		$total = $complete + $remaining;
		if($total > 0)
		{
			$percent = ($complete OR $remaining) ? round($complete / $total * 100) : 0;
			return array(
				'total' => $total,
				'complete' => $complete,
				'remaining' => $remaining,
				'percent' => $percent
			);
		}
		return array();
	}

	// private static function _state($issue)
	// {
	// 	if ($issue['state'] === 'closed')
	// 		return 'completed';
	// 	else if (Utilities::hasValue($issue, 'assignee') && count($issue['assignee']) > 0)
	// 		return 'active';
	// 	else
	// 		return 'queued';
	// }
}