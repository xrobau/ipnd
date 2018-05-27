<?php

namespace AussieVoIP\IPND\Records;

class DPCode extends Record {

	public $defaultval = \DPCODE;
	public $type = "X";
	public $size = 6;

	public function validate($v) {
		return true;
	}
}

