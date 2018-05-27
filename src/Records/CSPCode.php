<?php

namespace AussieVoIP\IPND\Records;

class CSPCode extends Record {

	public $defaultval = \CSPCODE;
	public $type = "X";
	public $size = 3;

	public function validate($v) {
		return true;
	}
}

