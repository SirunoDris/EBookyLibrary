<?php

function view($tpl, $data=[]) {
	if (is_array($data)) {
		extract($data, EXTR_OVERWRITE);
	} else {
		die("No data");
	}
	return (require APPVIEWS."/{$tpl}.view.php");
}

