<?php

use lithium\analysis\Logger;
use li3_dump\util\Dump;
use lithium\data\Connections;

// Filter mongo queries to console
if (isset($_SERVER['HTTP_USER_AGENT'])) {
	Connections::get('default')->applyFilter('_execute', function($self, $params, $chain) {
		// Hand the SQL in the params headed to _execute() to the logger:
		Dump::console(date("D M j G:i:s") . " " . $params['sql']);
		//exit($params['sql']);
		// Always make sure to keep the filter chain going.
		return $chain->next($self, $params, $chain);
	});
}

?>