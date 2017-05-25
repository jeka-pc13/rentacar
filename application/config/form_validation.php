<?php
$config['error_prefix'] = '<div class="alert alert-danger alert-dismissable">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
$config['error_sufix'] = '</div>';

/**
 * Valida  o formato  da data.
 */
function validateDate($date, $format = 'Y-m-d')
{
	$d = DateTime::createFromFormat($format, $date);
	return $d && $d->format($format) == $date;
}

function validateMatricula($matricula):bool{
	$aux[0] = substr($matricula, 0,2);
	$aux[1] = substr($matricula, 3,2);
	$aux[2] = substr($matricula, 6,2);
	$aux[3] = substr($matricula, 2,1);
	$aux[4] = substr($matricula, 5,1);


	if (is_numeric($aux[0]) && is_numeric($aux[1]) && ctype_alpha($aux[2]) && $aux[3] === "-" && $aux[4] === "-") {
		return true;
	}

	if (is_numeric($aux[2]) && is_numeric($aux[1]) && ctype_alpha($aux[0]) && $aux[3] === "-" && $aux[4] === "-") {
		return true;
	}

	

	return FALSE;

}
