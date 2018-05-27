<?php

namespace AussieVoIP\IPND\Records;

class PriorPublicNumber extends Record {

	public $defaultval = "";
	public $type = "X";
	public $size = 20;

	// Only digits may be used
	public function validate($v) {
		if ($v && !is_numeric($v)) {
			throw new \Exception("Prior Public Number '$v' is not numeric");
		}
		return true;
	}
}

